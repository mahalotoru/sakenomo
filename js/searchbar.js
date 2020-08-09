//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//hirasawa追加////////////////////////////////////////////////////////////////////////////////////////////////
/*詳細検索モーダルウィンドウ*/
// dialog bbs
$(function() {

    /*$('#sake_submit').click(function() {
      var touch_start_y;

      // タッチしたとき開始位置を保存しておく
      $(window).on('touchstart', function(event) {
            touch_start_y = event.originalEvent.changedTouches[0].screenY;
      });
      // スワイプしているとき
      $(window).on('touchmove.noscroll', function(event) {
            var current_y = event.originalEvent.changedTouches[0].screenY,
            height = $('#dialog_sake_option_background').outerHeight(),
            is_top = touch_start_y <= current_y && $('#dialog_sake_option_background')[0].scrollTop === 0,
            is_bottom = touch_start_y >= current_y && $('#dialog_sake_option_background')[0].scrollHeight - $('#dialog_sake_option_background')[0].scrollTop === height;

            // スクロール対応モーダルの上端または下端のとき
            if (is_top || is_bottom) {
              // スクロール禁止
              event.preventDefault();
            }
      });

      // スクロール禁止
      $('html, body').css('overflow', 'hidden');
      $("#dialog_sake_option_background").css({"display":"flex"});
    });*/

    /*$('#close_sake_menu').click(function() {
        // イベントを削除
        $(window).off('touchmove.noscroll');
        $('html, body').css('overflow', '');
        $("#dialog_sake_option_background").css({"display":"none"});
    });*/

    /*検索カテゴリ選択*/
    //1.クリックイベントの設定
    $(document).on('click', function(e) {
      //2.クリックされた場所の判定
      if(!$(e.target).closest('#search_content_position_adjust, #search_content').length && !$(e.target).closest('#category_menu_trigger').length) {
        /*$('#dialog_new_review').fadeOut();*/
        $("#search_content_position_adjust, #search_content").css({"display":"none"});
      }
      else if($(e.target).closest('#category_menu_trigger').length) {
        //3.ポップアップの表示状態の判定
        if($('#search_content_position_adjust, #search_content').is(':hidden')) {
          $('#search_content_position_adjust, #search_content').css({"display":"block"});
        }
        else {
          $("#search_content_position_adjust, #search_content").css({"display":"none"});
        }
      }
    });
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
// search bar
$(function () {

    //var username = <?php echo json_encode($_COOKIE['login_cookie']); ?>;
    var username = getCookie('login_cookie'); //

    $('#sake_submit_search').click(function() {

		event.preventDefault();

        var category = $('input[name="category"]').val();
        var keyword =  $('input[name="keyword"]').val();
        var data = "category=" + category;

        if(keyword && keyword != "") {
            data += "&keyword=" + keyword;
        }

        window.open('sake_library_search.php?' + data, '_self');
    });

    $('.searchColumn1').click(function() {
        //alert("searchColumn1" + $(this).next('.searchColumn1'));

        $(this).next('.searchColumn2').slideToggle();

        if ($(this).children(".plus_minus_icon").hasClass('active')) {
	        // activeを削除
	        $(this).children(".plus_minus_icon").removeClass('active');
        }
        else {
	        // activeを追加
	        $(this).children(".plus_minus_icon").addClass('active');
        }
    });

    $('#tab_search').createTabs({
	    text : $('#tab_search ul')
	});

    $('#close_dialog_message, #message_dialog_close').click(function() {
        $('#dialog_background').fadeOut();
        $('#dialog_message').fadeOut();
    });


	$('#tab_search ul li a').click(function() {
		$('.search_option_icon').css({"fill": "#8c8c8c"});
		$(this).find(".search_option_icon").css({"fill": "#3f3f3f"});
	});

    $('button[name="sake_option"]').click(function() {
        if($('#sake_option_input').val() && $('#sake_option_input').val() != "")
        {
            $('#sake_input').val($('#sake_option_input').val());
        }

        $('#hidden_sake_type').val("2");
    });

    $('button[name="sakagura_option"]').click(function() {
        if($('#sakagura_option_input').val() && $('#sakagura_option_input').val() != "")
        {
            $('#sake_input').val($('#sakagura_option_input').val());
        }
    });

    $('button[name="syuhanten_option"]').click(function() {
        if($('#syuhanten_option_input').val() && $('#syuhanten_option_input').val() != "")
        {
            $('#sake_input').val($('#syuhanten_option_input').val());
        }
    });

    $('#sake_form').submit(function() {
        return true;
    });

    $('.selection_trigger').click(function(){

		var obj = this;

		$('.selection_trigger').each(function(){
			if(this != obj)
			{
				$(this).next("ul").css({"display":"none"});
				$(this).removeClass('active');
				$(this).find('span:nth-child(2)').html('&#x25BC')
			}
		});

		$(this).next("ul").fadeToggle();
		$(this).next("ul").css({"overflow" : "auto"});

      $(this).toggleClass('active');

      if($(this).hasClass('active'))
        $(this).find('span:nth-child(2)').html('&#x25B2')
      else
        $(this).find('span:nth-child(2)').html('&#x25BC')
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////

    $("#return_to_home").click(function() {
        window.open('sake_search.php', '_self');
    });

    $('#login').click(function(){
        window.open("user_login_form.php", '_self');
    });

    $('#mypage').click(function(){
		var username = getCookie('login_cookie');
        window.open('user_view.php', '_self');
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////
    $('.header_arrow_icon').click(function(){
      $('#mypage_content').fadeToggle();

      if ($(this).hasClass('active')) {
        // activeを削除
        $(this).removeClass('active');
      } else {
        // activeを追加
        $(this).addClass('active');
      }
    });

    //$('#mypage_content').mouseleave(function(){
      //$('#mypage_content').fadeToggle();
    //});

    $('#side_logout, #logout').click(function(){
        var c = document.cookie.split("; ");

        for(i in c)
            document.cookie =/^[^=]+/.exec(c[i])[0]+"=;expires=Thu, 01 Jan 1970 00:00:00 GMT";

        alert("ログアウトしました");
        window.open('sake_search.php', '_self');
    });

    ///////////////////////////////////////////////////////////////////////////////////////////////
    // pulldown menu
    $('#user_message').click(function(){
		$("#dialog_background").fadeToggle();
        $('#dialog_message').fadeToggle();
    });

    $('#add_new_sake').click(function(){
       window.open('sake_add_form.php', '_self');
    });

    $('#add_sakagura').click(function(){
       window.open('sda_add_form.php', '_self');
    });

    $('#add_syuhanten').click(function(){
       window.open('syuhan_add_form.php', '_self');
    });

    $("#logo").click(function() {
        window.open('sake_search.php', '_self');
    });

    $("#cancel_search").click(function() {
       $("#sake_option").css({"display": "none"});
    });

	$('#close_main_menu').click(function() {
		$("#search_content, #search_content_position_adjust").css({"display":"none"});
	});

    ///////////////////////////////////////////////////////////////////////////////////////////////
    // portal menu
    $("#search_content .menu li").click(function() {

        var menuitem = $(this).text();
        var currentClass = $("#sake_input").attr("class")
        var href = "#general";

        if(menuitem == "すべて")
        {
            href = "#sake";
            $('input[name="category"]').val(1);
            $("#sake_input").attr("placeholder", "日本酒、酒蔵を検索");
            $("#sake_input").removeClass(currentClass);
            $("#sake_input").addClass("all_mode");
        }
        else if(menuitem == "日本酒")
        {
            href = "#sake";
            $('input[name="category"]').val(2);
            $("#sake_input").attr("placeholder", "日本酒を検索");
            $("#sake_input").removeClass(currentClass);
            $("#sake_input").addClass("sake_mode");
            //alert("new class:" +  $("#sake_input").attr("class"));
        }
        else if(menuitem == "酒蔵")
        {
            href = "#sake";
            $('input[name="category"]').val(3);
            $("#sake_input").attr("placeholder", "酒蔵を検索");
            $("#sake_input").removeClass(currentClass);
            $("#sake_input").addClass("sakagura_mode");
        }
        else if(menuitem == "酒販店（日本酒を買えるお店）")
        {
            href = "#sake";
            $('input[name="category"]').val(4);
            $("#sake_input").attr("placeholder", "酒販店を検索");
            $("#sake_input").removeClass(currentClass);
            $("#sake_input").addClass("syuhanten_mode");
        }

        $('#category_menu_trigger').addClass('active');
        $('#category_menu_trigger span:first-child').text($(this).attr("value"));
        $('#category_menu_trigger').click();
    });

    ////////////////////////////////////////////////////////////////////////////////////////
    // search input event
    $('#sake_content').on('click', '.general_class1', function(e){
        var sake_id = $(this).attr('sake_id');

        $("#sake_input").val(this.innerText);
        window.open('sake_view.php?sake_id=' + this.children[1].value, '_self');
    });

    $('#sake_content').on('click', '.general_class2', function(e){
        var sake_id = $(this).attr('sake_id');

        $("#sake_input").val(this.innerText);
        window.open('sda_view.php?id=' + this.children[1].value, '_self');
    });

    $(document).on('keyup', '.all_mode', function(e){

        var inputText = $("#sake_input").val().replace(/　/g, ' ');
        var count = inputText.length;
        var data = "search_text="+inputText;

        if($("#sake_option").css("display") == "block")
             return false;

        if(event.keyCode == 13 && count > 0) {
           $('#sake_content').empty();
             return false;
        }

        //$('#general_content').empty();
        $("#sake_content").css({"visibility": "hidden"});

        if(count >= 1)
        {
            $.ajax({
                type: "POST",
                url: "auto_multiple.php",
                data: data,
                dataType: 'json',

            }).done(function(data){

                //alert("input:" + $("#sake_input").val());

                $('#sake_content').empty();
                //alert("succeded:" + data + "length:" + data[0].sakagura);
                var sake = data[0].sake;
                var sakagura = data[0].sakagura;
                var syuhanten = data[0].syuhanten;
                var i = 0;

                if(sake != null)
                {
                    for(i = 0; i < sake.length; i++)
                    {
                        $('#sake_content').append('<li class="general_class1"><svg class="autocomplete_icon_sake"><use xlink:href="#bottle1616"/></svg>' + sake[i].sake_name + '<input type="hidden" value="' + sake[i].sake_id + '"></li>');
                    }
                }

                if(sakagura != null)
                {
                    $('#sake_content').append('<hr>');

                    for(i = 0; i < sakagura.length; i++)
                    {
                        $('#sake_content').append('<li class="general_class2"><svg class="autocomplete_icon_brewery"><use xlink:href="#brewery3630"/></svg>' + sakagura[i].sake_name + '<input type="hidden" value="' + sakagura[i].sake_id + '"></li>');
                    }
                }

                if(syuhanten != null)
                {
                    $('#sake_content').append('<hr>');

                    for(i = 0; i < syuhanten.length; i++)
                    {
                        $('#sake_content').append('<li class="general_class3"><svg class="autocomplete_icon_store"><use xlink:href="#store3030"/></svg>' + syuhanten[i].sake_name + '<input type="hidden" value="' + syuhanten[i].sake_id + '"></li>');
                    }
                }

                if(sake != null || sakagura != null)
                    $("#sake_content").css({"visibility": "visible"});

            }).fail(function(data){
                //alert("Failed:" + data);
            });
        }
        else
        {
            $('#sake_content').empty();
        }
    }); /* keyup */
    $(document).mouseup(function(e) 
    {
        if(!$("#sake_content").is(e.target) && $("#sake_content").has(e.target).length === 0) 
        {
            $("#sake_content").css({"visibility": "hidden"})
        }
    });

    /* 酒検索 */
    $(document).on('keyup', '.sake_mode', function(){

        var inputText = $("#sake_input").val().replace(/　/g, ' ');
        var count = inputText.length;
        var search_type = 1;
        var search_limit = 24;
        var data = "search_type=" + search_type + "&search_limit=" + search_limit + "&search_text=" + inputText;

        if($("#sake_option").css("display") == "block")
             return false;

        $("#sake_content").css({"visibility": "hidden"})
        $("#sake_content").empty();

        if(count >= 1)
        {
            $.ajax({
                type: "POST",
                url: "auto_complete.php",
		        data: data,
                dataType: 'json',

            }).done(function(data){

                //alert("succeded:" + data + "length:" + data.length);
                $('#sake_content').empty();

                for(var i = 0; i < data.length; i++)
                {
                    $('#sake_content').append('<li class="message_class" sake_id=' + data[i].sake_id + '><svg class="autocomplete_icon_sake"><use xlink:href="#bottle1616"/></svg>' + data[i].sake_name + '</li>');
                }

                $('.message_class').click(function() {
                    var sake_id = $(this).attr('sake_id');
                    //alert("sake_id:" + sake_id);
                    $("#sake_input").val(this.innerText);
                    window.open('sake_view.php?sake_id=' + sake_id, '_self');
                });

                if(sake != null || sakagura != null)
                    $("#sake_content").css({"visibility": "visible"});

            }).fail(function(data){
                alert("Failed:" + data);
            });
        }
        else
        {
            $('#sake_content').empty();
        }
    }); /* keyup */

    ////////////////////////////////////////////////////////////////////////////////////////////////////////
    /* 酒蔵検索　候補 */
    $(document).on('keyup', '.sakagura_mode', function(){
        var inputText = $("#sake_input").val();
        var count = inputText.length;
        var search_limit = 24;
        var search_type = 2;
        var data = "search_type=" + search_type + "&search_limit=" + search_limit + "&search_text=" + inputText;

        if($("#sake_option").css("display") == "block")
             return false;

        $("#sake_content").css({"visibility": "hidden"})

        if(count >= 1)
        {
            $.ajax({
                type: "POST",
                url: "auto_complete.php",
	                  data: data,
                dataType: 'json',

            }).done(function(data){

                //alert("succeded:" + data + "length:" + data.length);
                $('#sake_content').empty();

                for(var i = 0; i < data.length; i++)
                {
                    $('#sake_content').append('<li class="message_class">' + data[i].sake_name + '<input type="hidden" value="' + data[i].sake_id + '"></li>');
                }

                $("#sake_content").css({"visibility": "visible"});

                $(".message_class").click(function () {
                    var sake_id = $(this).attr('sake_id');

                    //alert("sake_id:" + sake_id);
                    $("#sake_input").val(this.innerText);
                    window.open('sda_view.php?id=' + this.children[0].value, '_self');
                });

            }).fail(function(data){
                //alert("Failed:" + data);
            });
        }
        else
        {
            $('#sake_content').empty();
        }
    }); /* keyup */

    $("#sakenomuguide").click(function() {
        window.open('serviceguide_user.html', '_self');
    });
});
