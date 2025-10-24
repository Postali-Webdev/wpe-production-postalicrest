(function (wp) {
	
	const { addFilter } = wp.hooks;
	const { createHigherOrderComponent } = wp.compose;
	const { Fragment, createElement } = wp.element;
	const { InspectorControls } = wp.blockEditor || wp.editor;
	const { PanelBody, ToggleControl } = wp.components;
	const { unregisterBlockVariation } = wp.blocks;

	// 1. Add a new attribute to core/group
	addFilter(
		'blocks.registerBlockType',
		'my-plugin/group-full-width-attribute',
		function(settings, name) {
			if (name !== 'core/group') return settings;

			settings.attributes = Object.assign({}, settings.attributes, {
				fullWidth: {
					type: 'boolean',
					default: false
				},
				contentWrapper: {
					type: 'boolean',
					default: false
				}
			});

			return settings;
		}
	);
    

	// 2. Add a toggle to InspectorControls
	const addLayoutSettings = createHigherOrderComponent(function(BlockEdit) {
		return function(props) {
			if (props.name !== 'core/group') {
				return createElement(BlockEdit, props);
			}

			return createElement(
				Fragment,
				{},
				createElement(BlockEdit, props),
				createElement(
					InspectorControls,
					{},
					createElement(
						PanelBody,
						{ title: 'Layout Settings', initialOpen: true },
						createElement(
							ToggleControl,
							{
								label: 'Full Width',
								checked: !!props.attributes.fullWidth,
								onChange: function(newValue) {
									props.setAttributes({ fullWidth: newValue });
								}
							}
						),
						createElement(
							ToggleControl,
							{
								label: 'Content Wrapper',
								checked: !!props.attributes.contentWrapper,
								onChange: function(newValue) {
									props.setAttributes({ contentWrapper: newValue });
								}
							}
						)
					)
				)
			);
		};
	}, 'addLayoutSettings');

	addFilter(
		'editor.BlockEdit',
		'my-plugin/group-full-width-toggle',
		addLayoutSettings
	);

	// 3. Add the full-width class to saved markup
	addFilter(
		'blocks.getSaveContent.extraProps',
		'my-plugin/group-add-class',
		function(extraProps, blockType, attributes) {
			if (blockType.name === 'core/group' && attributes.fullWidth) {
				extraProps.className = (extraProps.className || '') + ' full-width';
			}
			if (blockType.name === 'core/group' && attributes.contentWrapper) {
				extraProps.className = (extraProps.className || '') + ' content-wrapper';
			}
			return extraProps;
		}
	);
		
	wp.domReady(function () {
		unregisterBlockVariation('core/group', 'group-stack');
		unregisterBlockVariation('core/group', 'group-row');
		unregisterBlockVariation('core/group', 'group-grid');
	});

})(window.wp);
