$(document).ready( function() {
    //console.log('init', php_vars);
    
	
    /**
     * Handle Navigation Activ Class
     * @param  {[type]} e) {                           $(this).parent().children().each(function(e){            $(this).removeClass("current-menu-item")         })        $(this).addClass("current-menu-item");                      } [description]
     * @return {[type]}    [description]
     */
    $(document).on("click",".navbar-nav li",function(e) {

        // current-menu-item
        $(this).parent().children().each(function(e) {
            $(this).removeClass("current-menu-item") 
        })
        $(this).addClass("current-menu-item");
         // $(this).parent().each(function(e){
       
         // })
    });




    $(window).on('popstate', function(url) {
      loadContent(window.location.href);
    });


    function loadContent(url) {
           var data = {
                'action': 'hijax'
            };
           // var url = php_vars.url;

                //     $.ajax({
                //         type:'POST',
                //         dataType:'json',
                //         url: url,
                //         data: data,
                //         success : function(data, textStatus, XMLHttpRequest){
                            // console.log('Client Result: ',data );
                            // if(data.success){

                            // }else{
                    
                            // }
                //         }
                //     });
            function showNewContent(data) {
                $("#main_container").replaceWith(data);//html(data);
                $("#main_container").animate({ opacity:1 },125);
            };
            

            $.ajax({
                type:'POST',
                //dataType:'json',
                dataType: 'html',
                url: url,//e.currentTarget.href,
                data: data,
                success : function(data, textStatus, XMLHttpRequest){

                        $("#main_container").animate({
                            opacity:0
                        },125,function(){
                             showNewContent(data);
                             $(document).trigger('hijax');
                        });
                        
                    if(data.success){}else{}
                }
            });
    }



    /**
     * HiJack all links except those with the classname 'no_hijax' or teh path '/wp-admin/''
     * 
     */
        $(document).on('click', 'a', function(e) {

            console.log('no_hijax!' ,e.currentTarget.pathname) ;
            

            // if( $(this).hasClass('no_hijax') || e.currentTarget.pathname == "/wp-admin/") {
            //     return true;
            // }
            if( $(this).hasClass('hijax') ) {
                e.preventDefault();
                var path = e.currentTarget.pathname; // eg: '/contact/'
                window.history.pushState('forward', null, path);
                loadContent(e.currentTarget.href);
            }else{
                return true;
            }

        

            
        });


});