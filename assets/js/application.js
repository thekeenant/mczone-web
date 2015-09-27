loadTables();
$('.ajax').each(function() {
	var file = '/inc/ajax/' + $(this).attr('id').replace('ajax-','') + '.php';
	$(this).load(file, function() {
		loadTables();
	});
});

$('.nav-collapse .links li').hover(
  function(){ $(this).addClass('hover') },
  function(){ $(this).removeClass('hover') }
)

$("form").submit(function() {
    $(this).submit(function() {
        return false;
    });
    return true;
});

$('.tip').tipsy({gravity: 's'});

function loadTables() {
	$('.table-sort').dataTable();
	$('.table-no-sort').dataTable( {
		"bLengthChange": false,
		"bSort": false,
	});
	$('.table-no-page').dataTable( {
		"bPaginate": false,
		"bLengthChange": false,
		"bFilter": false,
		"bInfo": false,
	});
}
$.extend( $.fn.dataTableExt.oStdClasses, {
    "sWrapper": "dataTables_wrapper form-inline"
} );


function getParam(name) {
  name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
  var regexS = "[\\?&]" + name + "=([^&#]*)";
  var regex = new RegExp(regexS);
  var results = regex.exec(window.location.search);
  if(results == null)
    return "";
  else
    return decodeURIComponent(results[1].replace(/\+/g, " "));
}

getPrice();

var price = 0;
$('.checkbox').change(function() {
  getPrice();

  $('.price').val(price);
  if (price != 0)
    $('.item_price').attr('disabled', false);
  else
    $('.item_price').attr('disabled', true);

  $('.item_price').html('Purchase Cart ($' + price.toFixed(2) + ')');
});

function getPrice() {
  price = 0;
  $('.item_name').val('');
  $('.checkbox').each(function() {
    if ($(this).is(':checked')) {
      if (typeof kit_price != 'undefined')
        price += kit_price;
      else
        price += 2.50;
      $('.item_name').val($('.item_name').val() + $(this).attr('name') + ",");
    }
  });
};

$('.subscription-search').submit(function() {
  $('#ajax-subscriptions').html('<img src="/assets/img/loading.gif" />').load('/inc/ajax/subscriptions.php?username=' + $('.username').val(), function() {
    
  });
});

$('form.no-submit').submit(function(event){
  event.preventDefault();
});


window.setInterval(totalplayers, 10000);

function totalplayers() { 
  $(".total-players").load("/inc/mc/players.php?server=play.mczone.co"); 
}

$('.fancy-kits-form').submit(function () {
  if ($("#custom").val() == "") {
      alert("Please fill in your Minecraft username (not email)!");
      return false;
  }
  var regex = /^[A-Za-z0-9_-]{3,16}$/;
  if (!$("#custom").val().match(regex)) {
    alert("Please fill in your Minecraft username (not email)!");
    return false;
  }
  $(this).submit();
});

$(".rank").hover(function() {
  $("." + $(this).attr("id") + "-info").slideDown(600);
}, function() {
  $("." + $(this).attr("id") + "-info").slideUp(600);
});