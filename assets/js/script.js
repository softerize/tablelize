function indexPosition() {
    if($('#tablelize').offset().top < 0) {
        $('.index').addClass('scroll');
    } else {
        $('.index').removeClass('scroll');
    }
}

// Get all anchors and add to the index
$('h1 .anchor, h2 .anchor, h3 .anchor, h4 .anchor').each(function(){
    var $this = $(this);
    var $header = $(this).parent();
    
    var link = '<' + $header.prop("tagName") + '>'
        + '<a href="#' + $this.attr("id") + '">'
        + $header.text()
        + '</a>'
        + '</' + $header.prop("tagName") + '>';
        
    $('.index').append(link);
});

// Set multi level menu
$('.index h4').each(function(){
    var $this = $(this);
    
    if($this.prev().prop("tagName") == 'H3') {
        $this.prev().addClass('multi-level').append('<small>+</small>');
    }
})
$('.multi-level').click(function() {
    var $this = $(this);
    
    if($this.find('small').text() == '+') {
        $('.index h4').hide();
        $('.index h3 small').html('+');
        
        $this.find('small').html('-');
        $this.nextUntil('h1,h2,h3').show();
    } else {
        $this.find('small').html('+');
        $this.nextUntil('h1,h2,h3').hide();
    }
});

    
// Set initial idx position
indexPosition();

// Update idx according to scroll
$(window).scroll(function(){
    indexPosition();
});

// Show/hide menu
$('.show-index').click(function(){
    var $index = $(this).parent();
    if($index.offset().left > 0) {
        $index.animate({"left":"-170px"}).removeClass('showing');
        $(this).animate({"right":"-30px"});
    } else {
        $index.animate({"left":"20px"}).addClass('showing');
        $(this).animate({"right":"10px"});
    }
});