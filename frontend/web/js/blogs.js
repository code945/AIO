/**
 * Created by hongxu.lin on 5/20/2016.
 */
$(document).ready(function () {
    $("#spinner").show();
    $("#posts").hide();
    $.post("post/query", {},
        function (result) {
            if (result.error_code == 1) {
                var row = "";
                $.each(result.data, function (idx, item) {
                        row +=
                                 ' <div class="blog-item">'
                               + '     <div class="row">'
                               + '     <div class="col-lg-2 col-sm-2 text-right">'
                               + '     <div class="date-wrap">'
                               + '     <span class="month">'+item.created_at+'</span>'
                               + '     </div>'
                               + '     <div class="author">'
                               + '     By <a href="#">Leo</a>'
                               + '     </div>'
                               + '     </div>'
                               + '     <div class="col-lg-10 col-sm-10">'
                               + '     <h1 class="no-margin"><a href="/post/view?id='+item.id+'">'+item.title+'</a></h1>'
                               + ' <div class="infopanel">'
                               + '     <span class="tagspan"><i class="icon-eye-open"></i> 495 浏览</span>'
                               + ' <span class="tagspan"><i class="icon-comments"></i> 25 评论</span>'
                               + ' </div>'
                              + ' <p> '+ Generate_Brief( item.content,300)+' </p>'
                               + ' <a href="/post/view?id='+item.id+'" class="btn btn-danger">继续阅读</a>'
                               + '     </div>'
                               + '     </div>'
                               + '     </div>';
                    }
                )
                $("#posts").html(row)
                $("#spinner").hide();
                $("#posts").show();
            }
        }
    );

})




function Generate_Brief(text,length){
    if(text.length < length) return text;
    var Foremost = text.substr(0,length);
    var re = /<(\/?)(BODY|SCRIPT|P|DIV|H1|H2|H3|H4|H5|H6|ADDRESS|OBJECT |A|UL|OL|LI|BASE|META|LINK|HR|BR|PARAM|AREA|INPUT|SPAN)[^>]*(>?)/ig;
    var Singlable = /BASE|META|LINK|HR|BR|PARAM|IMG|AREA|INPUT/i
    var Stack = new Array(), posStack = new Array();
    while(true){
        var newone = re.exec(Foremost);
        if(newone == null) break;

        if(newone[1] == ""){
            var Elem = newone[2];
            if(Elem.match(Singlable) && newone[3]!= ""){
                continue;
            }
            Stack.push(newone[2].toUpperCase());
            posStack.push(newone.index);

            if(newone[3] == "") break;
        }else{
            var StackTop = Stack[Stack.length-1];
            var End = newone[2].toUpperCase();
            if(StackTop == End){
                Stack.pop();
                posStack.pop();
                if(newone[3] == ""){
                    Foremost = Foremost+">";
                }
            }

        };
    }
    var cutpos = posStack.shift();
    Foremost = Foremost.substring(0,cutpos);

    return Foremost;
}