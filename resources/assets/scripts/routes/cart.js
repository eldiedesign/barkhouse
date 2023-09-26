export default {
  init() {
    $(document.body).on('updated_cart_totals', function() {
      $.ajax({
        url : '/wp-content/themes/barkhouse-shop/resources/ajax/cart-total.php',
        type : 'post',
        success : function( data ) {
          document.querySelector('#the-cart-count').textContent = data;
        },
      });
    });

    $(document.body).on('wc_cart_emptied', function() {
      document.querySelector('#the-cart-count').textContent = 0;
    });
  },
};
