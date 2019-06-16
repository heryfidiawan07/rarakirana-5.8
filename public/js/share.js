var popupSize = {
    width: 780,
    height: 550
};

var metaUrl   = $("meta[name=url]").attr("content");
var metaTitle = $("meta[name=title]").attr("content");
var metaDesc  = $("meta[name=description]").attr("content");
var metaImage = $("meta[name=image]").attr("content");

$('.share > a').hover(function(){
    var href = $(this).attr('href');
    var find = ['`url`', '`title`', '`description`', '`img`'];
    var replace = [metaUrl, metaTitle, metaDesc, metaImage];
    var newHref = href.replace(find[0], replace[0]).replace(find[1], replace[1]).replace(find[2], replace[2]).replace(find[3], replace[3]);
    $(this).attr('href',newHref);
    //console.log(newHref);
    $(document).on('click', '.share > a', function(e){
         e.preventDefault();

        var
            verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
            horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

        var popup = window.open(newHref, 'share',
            'width='+popupSize.width+',height='+popupSize.height+
            ',left='+verticalPos+',top='+horisontalPos+
            ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

        if (popup) {
            popup.focus();
            e.preventDefault();
        }

    });
});

