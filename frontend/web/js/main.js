console.log('test1');
$(document).ready(function(){
    var category = $('#category');
    var category_btn = $('#category-btn');
    var search = $('#search');
    var search_btn = $('#search-btn');
    category.hide();
    search.hide();

    category_btn.click(function(){
       if(category.is(':visible')){
           category.hide();
       }else {
           category.show();
       }
    });

    search_btn.click(function(){
       if(search.is(':visible')){
           search.hide();
       }else{
           search.show();
       }
    });
    console.log('testJq');
});