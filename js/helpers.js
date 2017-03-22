/**
 * Created by Usuario on 21/01/2017.
 */

$(document).on("click",".remove",function(e){
    $(this).closest("li").remove();
});

$(document).ready(function(){
    $(".sortable").sortable();
});
function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}

$(document).on("sortstop",".sortable",function(){

    console.log(arrayFromUl($("#paradas-list li")));

});
function arrayFromUl(ul)
{
    var data=[];

    $.each(ul,function(k,v)
    {
        var item=$(v);

            data.push(item.data("value"));



    }

    );
    return data;

}
function upperCaseF(a){
    setTimeout(function(){
        a.value = a.value.toUpperCase();
    }, 1);
}

function removeLast(strng,char){
    var n=strng.lastIndexOf(char);
    var a=strng.substring(0,n)
    return a;
}

function formatBytes(bytes,decimals) {
    if(bytes == 0) return '0 Byte';
    var k = 1000;
    var dm = decimals + 1 || 3;
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    var i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}
(function ($) {
    $.fn.serializeFormJSON = function () {

        var o = {};
        //    var a = this.serializeArray();
        $(this).find('input[type="hidden"], input[type="text"], input[type="password"], input[type="checkbox"]:checked, input[type="radio"]:checked, select').each(function() {
            if ($(this).attr('type') == 'hidden') { //if checkbox is checked do not take the hidden field
                var $parent = $(this).parent();
                var $chb = $parent.find('input[type="checkbox"][name="' + this.name.replace(/\[/g, '\[').replace(/\]/g, '\]') + '"]');
                if ($chb != null) {
                    if ($chb.prop('checked')) return;
                }
            }
            if (this.name === null || this.name === undefined || this.name === '')
                return;
            var elemValue = null;
            if ($(this).is('select'))
                elemValue = $(this).find('option:selected').val();
            else elemValue = this.value;
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(elemValue || '');
            } else {
                o[this.name] = elemValue || '';
            }
        });
        return o;
    };
})(jQuery);