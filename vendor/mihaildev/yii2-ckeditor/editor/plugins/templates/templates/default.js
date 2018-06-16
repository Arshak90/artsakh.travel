/*
 Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.md or http://ckeditor.com/license
*/
CKEDITOR.addTemplates("default", {
    imagesPath: CKEDITOR.getUrl(CKEDITOR.plugins.getPath("templates") + "templates/images/"),
    templates: [{
        title: "Image and Title",
        image: "template1.gif",
        description: "One main image with a title and text that surround the image.",
        html: '<div class="container template-text template-1"><div class="item"><div class="row"><div class="col-md-7 col-sm-6 com-xs-12">      <h2>Lorem ipsum dolor</h2>    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultrices vulputate leo sed malesuada. Donec telltus massa, impe rdiet fermentum massa eu, varius elementum est. Sed blandit ipsum eros, quis vulputate purus malesuada elementum. Vestibulum lacinia nisi vel orci porta, ac dictum ligula aliquet. Aenean in est vulputate, semper leo vel, convallis dui.Nullam consectetur sagittis ante vel vestibulum. </p>    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent ultrices vulputate leo sed malesuada. Donec telltus massa, impe rdiet fermentum massa eu, varius elementum est. Sed blandit ipsum eros, quis vulputate purus malesuada elementum. Vestibulum lacinia nisi vel orci porta, ac dictum ligula aliquet. Aenean in est vulputate, semper leo vel, convallis dui. Nullam consectetur sagittis ante vel vestibulum. </p>    </div>    <div class="col-md-5 col-sm-6 com-xs-12">        <div class="img-block">        <img src="img/Hyunot.JPG" alt="Hyunot">        </div>        </div>        </div>        </div>'
    }, {
        title: "Strange Template",
        image: "template2.gif",
        description: "A template that defines two colums, each one with a title, and some text.",
        html: '<table cellspacing="0" cellpadding="0" style="width:100%" border="0"><tr><td style="width:50%"><h3>Title 1</h3></td><td></td><td style="width:50%"><h3>Title 2</h3></td></tr><tr><td>Text 1</td><td></td><td>Text 2</td></tr></table><p>More text goes here.</p>'
    }, {
        title: "Text and Table",
        image: "template3.gif",
        description: "A title with some text and a table.",
        html: '<div style="width: 80%"><h3>Title goes here</h3><table style="width:150px;float: right" cellspacing="0" cellpadding="0" border="1"><caption style="border:solid 1px black"><strong>Table title</strong></caption><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr></table><p>Type the text here</p></div>'
    }]
});