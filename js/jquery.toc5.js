/**************************************************
Author      : Imri Paloja
Email       : imri.paloja@gmail.com
HomePage    : www.eurobytes.nl
Version     : 0.1
Name        : index.js
Description : Automatic index
**************************************************/

/*          Notes

    1.  If a header has the same name - which is not recommended - 
        the script will apply the id's twice. Therefore clicking to 
        the second header with the same id will not work!

            Possible fix:
            setInterval(function() {
                var number = 1 + Math.floor(Math.random() * 100);
                $('id').text(number);
            });
            
    2.  The script needs a `body` not `<body onload="onLoad()">`. 
        It will not work without!

*/

// When clicked on the tocbutton, the following will be excecuted:
function index() {
    var index =
        "<ul id=\"IndexJS\" style=\"display: block;\">" +
        "<li id=\"tocid\">Table of Content</li>";

    // searches every tag you put in here
    $("h1,.post-body  h2,.post-body  h3,.post-body  h4,.post-body  h5,.post-body  h6").each(function() {

        el = $(this);
        title = el.text();
        id = "#" + el.text().replace(/\s/g, ""); // get the content of the header tags removes spaces and puts a # in front of it.
        hid = el.text().replace(/\s/g, ""); // get the content of the header tags
        el.attr('id', "" + hid + ""); // applies the header content in the id tag.

        lHeaders =
            "<li>\n" +
            "<a href='" + id + "' title='" + title + "' >" + title +
            "</a>\n" +
            "</li>\n";

        index += lHeaders;

    });

    index +=
        "</li>" +
        "</ul>";

    // This will put the list of headers, in the article tag. 
    // Rename to where you would like it to appear!
    $(".article1").prepend(index);

    //$('#toc').attr('style', 'display: none;');
    $('#toc').remove();
    $('#tocbuttonstyle').remove();

}

window.onload = index;


$(window).scroll(function() {
  $("#slidebox").css($(this).scrollTop() > 700 ? {
    right: "0px"
  } : {
    right: "-360px"
  });
}), $(document).ready(function() {
  var i = $("#slidebox"),
    s = $("#slidebox-close"),
    o = $("#slidebox-minimize"),
    l = $("#slidebox-maximize");
  l.hide(), s.click(function() {
    i.css({
      right: "-350px"
    }), i.fadeOut("slow")
  }), o.click(function() {
    i.toggleClass("hide"), $(this).hide(), l.show()
  }), l.click(function() {
    i.toggleClass("hide"), $(this).hide(), o.show()
  })
});