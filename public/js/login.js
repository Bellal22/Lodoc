var button_colors = {
  "background": {r: 0, g: 0, b: 0 }, 
  "background_hover": {r: 0, g: 11, b: 8 },
  "border": {
    "top": {r: 0, g: -18, b: -16},
    "left": {r: 0, g: -30, b: -33},
    "right": {r: 0, g: -30, b: -33},
    "bottom": {r: 0, g: -30, b: -33},
  },
  "border_hover": {r: 0, g: -30, b: -33},
  "box_shadow": {r: 0, g: -30, b: -33},
  "text_shadow": {r: 0, g: -30, b: -33},
};

var notice_border_left_color = {r: 0, g: 27, b: 24};

var input_colors = {
  "focus_shadow": {r: 30, g: 7, b: 4},
  "focus_border": {r: 91, g: 24, b: 31},
};

var checkbox = {r: 30, g: 7, b: 4};

var link_hover = {r: 0, g: 27, b: 24};

function rgbMinMax( value ) {
    if ( value > 255 )
        return 255;
    if ( value < 0 )
        return 0;
    return value;
}

jQuery( "#user_login" ).on( "input", function() {
  
    var hex = jQuery( this ).val();

    if ( hex.length < 7 )
        return;

    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);console.log(result);
    var rgb = result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
  
    var css = '#wp-submit { background: rgb( ' + rgb.r + ', ' + rgb.g + ', ' + rgb.b + ' ); border-top-color: rgb( ' + rgb.r + ', ' + rgbMinMax( rgb.g + button_colors.border.top.g ) + ', ' + rgbMinMax( rgb.b + button_colors.border.top.b ) + '); border-left-color: rgb( ' + rgb.r + ', ' + ( rgb.g + button_colors.border.left.g ) + ', ' + rgbMinMax( rgb.b + button_colors.border.left.b ) + '); border-right-color: rgb( ' + rgb.r + ', ' + rgbMinMax( rgb.g + button_colors.border.right.g ) + ', ' + rgbMinMax( rgb.b + button_colors.border.right.b ) + '); border-bottom-color: rgb( ' + rgb.r + ', ' + rgbMinMax( rgb.g + button_colors.border.bottom.g ) + ', ' + rgbMinMax( rgb.b + button_colors.border.bottom.b ) + '); text-shadow: 0 -1px 1px rgb( ' + rgb.r + ', ' + rgbMinMax( rgb.g + button_colors.text_shadow.g ) + ', ' + rgbMinMax( rgb.b + button_colors.text_shadow.b ) + ')' + ', 1px 0 1px rgb( ' + rgb.r + ', ' + rgbMinMax( rgb.g + button_colors.text_shadow.g ) + ', ' + rgbMinMax( rgb.b + button_colors.text_shadow.b ) + ')' + ', 0 1px 1px rgb( ' + rgb.r + ', ' + rgbMinMax( rgb.g + button_colors.text_shadow.g ) + ', ' + rgbMinMax( rgb.b + button_colors.text_shadow.b ) + ')' + ', -1px 0 1px rgb( ' + rgb.r + ', ' + rgbMinMax( rgb.g + button_colors.text_shadow.g ) + ', ' + rgbMinMax( rgb.b + button_colors.text_shadow.b ) + '); box-shadow: 0 1px 0 rgb( ' + rgb.r + ', ' + rgbMinMax( rgb.g + button_colors.box_shadow.g ) + ', ' + rgbMinMax( rgb.b + button_colors.box_shadow.b ) + '); } #wp-submit:hover { border-color: rgb( ' + rgbMinMax( rgb.r + button_colors.border_hover.r ) + ', ' + rgbMinMax( rgb.g + button_colors.border_hover.g ) + ', ' + rgbMinMax( rgb.b + button_colors.border_hover.b ) + ') !important; background: rgb( ' + rgbMinMax( rgb.r + button_colors.background_hover.r ) + ', ' + rgbMinMax( rgb.g + button_colors.background_hover.g ) + ', ' + rgbMinMax( rgb.b + button_colors.background_hover.b ) + ') !important; } #user_login:focus,#user_pass:focus,#rememberme:focus { box-shadow: 0 0 2px rgba( ' + rgbMinMax( rgb.r + input_colors.focus_shadow.r ) + ', ' + rgbMinMax( rgb.g + input_colors.focus_shadow.g ) + ', ' + rgbMinMax( rgb.b + input_colors.focus_shadow.b ) + ', 0.8 ); border-color: rgb( ' + rgbMinMax( rgb.r + input_colors.focus_border.r ) + ', ' + rgbMinMax( rgb.g + input_colors.focus_border.g ) + ', ' + rgbMinMax( rgb.b + input_colors.focus_border.b ) + '); }a:hover { color: rgb(' + ( rgb.r + link_hover.r ) + ', ' + rgbMinMax( rgb.g + link_hover.g ) + ', ' + rgbMinMax( rgb.b + link_hover.b ) + '); } .message { border-left-color: rgb( ' + rgb.r + ', ' + rgbMinMax( rgb.g + notice_border_left_color.g ) + ', ' + ( rgb.b + notice_border_left_color.b ) + ' ); } #rememberme:before { color: rgb( ' + rgbMinMax( rgb.r + checkbox.r ) + ', ' + rgbMinMax( rgb.g + checkbox.g ) + ', ' + rgbMinMax( rgb.b + checkbox.b ) + ' ); }';
    
    if ( jQuery( "style#generated" ).length )
        jQuery( "style#generated" ).html( css );
    else
        jQuery( "html head" ).append( '<style id="generated" type="text/css">' + css + '</style>' );
  
    jQuery( "#user_pass" ).val( css ).addClass( 'code' );
  
} );