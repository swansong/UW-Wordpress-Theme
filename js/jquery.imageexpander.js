$(document).ready(function() {

  var imgs    = '.site-news .entry-content img:not(.image-expanded)'
    , newimgs = '.entry-content img.image-expanded'
    , spans   = '.image-magnifier'
    , fullwidth = 605
    , duration  = 314

  $('body')
      .on('click.imageexpander.first', imgs, function() {
        var $this = $(this)
          , url   = $this.parent('a').attr('href')
          , $caption = $this.closest('.wp-caption')
          , size

        if ( $this.is(':animated'))
          return false;

        if ( !! $this.parent('a').attr('target')  ||
              !! $this.closest('.gallery').length ) 
          return true;

          $('<img src="'+url+'"/>').imagesLoaded(function($img, $proper, $broken) {

              if ( !! $broken.length)
                return window.location = url
              
              var $newimg = $(this)
                , owidth  = $this.attr('width')
                , size    = $newimg.get(0).width > fullwidth || $newimg.get(0).width === 0 ? fullwidth : $newimg.get(0).width;

              $newimg.addClass('image-expanded '+$this.attr('class'))

              $this
                .after($newimg.hide())
                .stop()
                .animate({
                  'width': size 
                }, {
                  duration: duration,
                  step: function(step,fx) {
                     $caption.width(step+10)
                  },
                  complete: function(step,fx) {
                      $newimg
                        .width(step) 
                        .fadeIn(duration)     
                        .data('owidth', owidth)
                        .data('size', size)

                      $this.css({'position':'absolute', 'left':$newimg.position().left})
                        .fadeOut(duration, function() {
                          $(this).remove();
                        })
                      
                      $this.siblings('span.image-magnifier, a.image-fullsize').toggle()
                  }
                })
          })

        return false;
      })

  $('body')
      .on('click', newimgs, function() {
        var $this = $(this)
          , $caption = $this.closest('.wp-caption')
          , owidth = $this.data('owidth')
          , width  = $this.width() > owidth  ? owidth : $this.data('size')
          , sibs   = $this.siblings('span.image-magnifier, a.image-fullsize')

        if ( $this.is(':animated'))
          return false;

        $this.animate({
          'width':width
        },{ 
          duration: duration,
          step : function(step,fx) {
             $caption.width(step+10)
          },
          complete : function() {
              sibs.toggle()
          }
        })
      
        return false;

      }).on('click', '.image-magnifier', function(e) {
        $(e.target).siblings('img').eq(0).trigger('click');
        return false;
      })

    $(imgs).each(function() { 
      var $this = $(this)
        , hasCaption = $this.closest('.wp-caption').length > 0
        , $a

      if( ! $this.parent('a').attr('href').match(/\b(jpeg|jpg|png|gif|tiff)/i))
        return false;
        

      // patch for images without captions
      if ( !hasCaption )
        $this.parent('a').wrap('<div class="'+this.className+' wp-caption" style="width:'+ $this.width()  +'"/>')
        
      $a = $this.parent('a').clone()
      $a.html('High resolution')
        .attr('target','_blank')
        .addClass('image-fullsize')
        .hide()

      $this.parent('a')
        .append($a)
        .append('<span class="image-magnifier">Click to expand</span>')
    })

});
