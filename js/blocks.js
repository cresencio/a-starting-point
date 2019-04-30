// wp.blocks.registerBlockStyle( 'core/quote', {
//     name: 'fancy-quote',
//     label: 'Fancy Quote'
// } );

// Our filter function
function setBlockCustomClassName( className, blockName ) {

    return blockName === 'core/asp' ? 'asp-block' : className + ' asp-block';
}

var $css_class_field = acf.findField('field_5c941c70ebf67');

// if the custom field has a value
if( $css_class_field.val() ) {

  wp.hooks.addFilter(
      'blocks.getBlockDefaultClassName',
      'asp-theme-blocks',
      setBlockCustomClassName
  );

}
