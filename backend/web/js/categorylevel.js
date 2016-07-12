/**
 * Created by hongxu.lin on 5/19/2016.
 */

function showTags() {
   alert("oldids:"+$("#oldtags").val()+"\n newids:" +$("#newtags").val())


}

$(document).ready(function () {
    $("#tags").select2({
        tags: true,
        tokenSeparators: [",", " "],
        createSearchChoice: function(term, data) {
            if ($(data).filter(function() {
                    return this.text.localeCompare(term) === 0;
                }).length === 0) {
                return {
                    id: term,
                    text: term
                };
            }
        },
        multiple: true,
        ajax: {
            url: "/tag/query",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;
                var r = $.map(data.items, function (obj) {
                    obj.text = obj.text || obj.name; // replace name with the property used for the text
                    return obj;
                });
                return {
                    results: r,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            },
            cache: true
        },
        minimumInputLength: 1,
    }).on("change", function(e) {

        var oldArray = $(this).find('[data-select2-tag !="true"]');
        var newArray = $(this).find('[data-select2-tag="true"]');
        if(newArray.length){
            var o="";
            $.each(newArray,function(idx,data)
            {
                if(idx==0)
                    o+= $(data).val();
                else
                    o+= "," +$(data).val();
            })
            $("#newtags").val(o);
        }
        else
        {
            $("#newtags").val('');
        }

        if(oldArray.length){
            var o="";
            $.each(oldArray,function(idx,data)
            {
                if(idx==0)
                    o+= $(data).val();
                else
                    o+= ","+ $(data).val();
            })
            $("#oldtags").val(o);
        }
        else
        {
            $("#oldtags").val('');
        }


    });



    $.post("/category/downlevel", {},
        function (result) {
            if (result.error_code == 1) {
                var row = "";
                $.each(result.data, function (idx, item) {
                        row += '<option value="'+item.id+'">'+item.name+'</option>>'
                    }
                )
                $("#post-category_id").html(row)
            }
        }
    );

})

function uplevel(id) {
    $.post("/category/uplevel", {'id':id},
        function (result) {
            if (result.error_code == 1) {
                var row = "";
                $.each(result.data, function (idx, item) {
                        row += '<option value="'+item.id+'">'+item.name+'</option>>'
                    }
                )
                if(row != "")
                    $("#post-category_id").html(row)
            }
        }
    );
}

function downlevel(id) {
    $.post("/category/downlevel", {'id':id},
        function (result) {
            if (result.error_code == 1) {
                var row = "";
                $.each(result.data, function (idx, item) {
                        row += '<option value="'+item.id+'">'+item.name+'</option>>'
                    }
                )
                if(row != "")
                $("#post-category_id").html(row)
            }
        }
    );
}
