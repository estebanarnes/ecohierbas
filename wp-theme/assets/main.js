// Main JavaScript for Ecohierbas theme
(function(){
  document.addEventListener('DOMContentLoaded', function(){
    // Mobile menu toggle
    var toggle = document.querySelector('.menu-toggle');
    var mobileMenu = document.querySelector('.mobile-menu');
    if(toggle && mobileMenu){
      toggle.addEventListener('click', function(){
        mobileMenu.classList.toggle('open');
      });
    }

    // Hero parallax effect
    var heroBg = document.querySelector('.hero .bg');
    if(heroBg){
      window.addEventListener('scroll', function(){
        var scrolled = window.pageYOffset || document.documentElement.scrollTop;
        heroBg.style.transform = 'translateY(' + (scrolled * 0.5) + 'px) scale(1.1)';
      });
    }

    // Cart logic
    var cartBtn = document.querySelector('.cart-button');
    var cartPanel = document.getElementById('cart-panel');
    var cartCount = document.querySelector('.cart-count');

    function renderCart(items){
      var list = cartPanel.querySelector('.cart-items');
      list.innerHTML = '';
      var total = 0;
      items.forEach(function(item){
        total += item.price * item.qty;
        var li = document.createElement('li');
        li.innerHTML = '<span>' + item.title + '</span><div class="qty-controls"><button class="decrease" data-id="' + item.id + '">-</button><span>' + item.qty + '</span><button class="increase" data-id="' + item.id + '">+</button></div><span>$' + (item.price * item.qty).toFixed(0) + '</span><button class="remove-item" data-id="' + item.id + '">×</button>';
        list.appendChild(li);
      });
      var totalDiv = cartPanel.querySelector('.cart-total');
      if(totalDiv){ totalDiv.textContent = 'Total: $' + total.toFixed(0); }
    }
    if(typeof ecohierbas !== 'undefined'){
      cartCount.textContent = ecohierbas.cartCount || 0;
      renderCart(ecohierbas.cartItems || []);
    }

    if(cartBtn && cartPanel){
      cartBtn.addEventListener('click', function(){
        cartPanel.classList.add('open');
      });
      cartPanel.querySelector('.close-cart').addEventListener('click', function(){
        cartPanel.classList.remove('open');
      });
    }

    document.body.addEventListener('click', function(e){
      if(e.target.classList.contains('add-to-cart')){
        var id = e.target.getAttribute('data-product');
        var body = 'action=ecohierbas_add_to_cart&product_id=' + id + '&quantity=1&_ajax_nonce=' + ecohierbas.nonce;
        fetch(ecohierbas.ajaxurl, {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:body})
          .then(function(r){ return r.json(); })
          .then(function(data){
            cartCount.textContent = data.count;
            fetch(ecohierbas.ajaxurl, {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:'action=ecohierbas_get_cart'})
              .then(function(r){ return r.json(); })
              .then(function(d){ renderCart(d.items); });
            showToast('Producto añadido al carrito');
          });
      }
      if(e.target.classList.contains('remove-item')){
        var rid = e.target.getAttribute('data-id');
        var body2 = 'action=ecohierbas_remove_from_cart&product_id=' + rid + '&_ajax_nonce=' + ecohierbas.nonce;
        fetch(ecohierbas.ajaxurl, {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:body2})
          .then(function(r){ return r.json(); })
          .then(function(data){
            cartCount.textContent = data.count;
            fetch(ecohierbas.ajaxurl, {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:'action=ecohierbas_get_cart'})
              .then(function(r){ return r.json(); })
              .then(function(d){ renderCart(d.items); });
            showToast('Producto eliminado');
          });
      }
      if(e.target.classList.contains('increase') || e.target.classList.contains('decrease')){
        var pid = e.target.getAttribute('data-id');
        var parent = e.target.parentElement;
        var span = parent.querySelector('span');
        var current = parseInt(span.textContent);
        var newQty = current + (e.target.classList.contains('increase') ? 1 : -1);
        if(newQty < 1) return;
        var body3 = 'action=ecohierbas_update_cart&product_id=' + pid + '&quantity=' + newQty + '&_ajax_nonce=' + ecohierbas.nonce;
        fetch(ecohierbas.ajaxurl, {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:body3})
          .then(function(r){ return r.json(); })
          .then(function(data){
            cartCount.textContent = data.count;
            renderCart(data.items);
          });
      }
      if(e.target.classList.contains('view-detail')){
        var card = e.target.closest('.product-card');
        var modal = document.getElementById('product-modal');
        if(card && modal){
          modal.classList.add('open');
          modal.querySelector('.modal-img').src = card.getAttribute('data-img');
          modal.querySelector('.modal-title').textContent = card.getAttribute('data-title');
          modal.querySelector('.modal-desc').textContent = card.getAttribute('data-desc');
          var pr = card.getAttribute('data-price');
          modal.querySelector('.modal-price').textContent = pr ? '$' + pr : '';
          modal.querySelector('.modal-add').setAttribute('data-product', card.getAttribute('data-id'));
        }
      }
      if(e.target.classList.contains('close-modal')){
        var pm = document.getElementById('product-modal');
        if(pm){ pm.classList.remove('open'); }
      }
    });

    // Product filters
    var filterButtons = document.querySelectorAll('.product-filter');
    var productCards = document.querySelectorAll('.product-card');
    filterButtons.forEach(function(btn){
      btn.addEventListener('click', function(){
        filterButtons.forEach(function(b){ b.classList.remove('active'); });
        btn.classList.add('active');
        var cat = btn.getAttribute('data-cat');
        productCards.forEach(function(card){
          if(cat === 'all' || card.getAttribute('data-cat').split(' ').includes(cat)){
            card.style.display = 'block';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });

    var searchInput = document.getElementById('product-search');
    if(searchInput){
      searchInput.addEventListener('input', function(){
        var term = searchInput.value.toLowerCase();
        productCards.forEach(function(card){
          var title = card.getAttribute('data-title').toLowerCase();
          card.style.display = title.indexOf(term) !== -1 ? 'block' : 'none';
        });
      });
    }

    // Offer popup
    var offer = document.getElementById('offer-popup');
    if(offer && !localStorage.getItem('ec_offer_seen')){
      offer.classList.add('open');
      offer.querySelector('.close-offer').addEventListener('click', function(){
        offer.classList.remove('open');
        localStorage.setItem('ec_offer_seen','1');
      });
    }

    // Form validation
    document.querySelectorAll('.needs-validation').forEach(function(form){
      form.addEventListener('submit', function(e){
        if(!form.checkValidity()){
          e.preventDefault();
          showToast('Por favor completa todos los campos correctamente');
        }
      });
    });

    // B2B modal
    var b2bBtn = document.querySelector('.b2b-button');
    var b2bModal = document.getElementById('b2b-modal');
    if(b2bBtn && b2bModal){
      b2bBtn.addEventListener('click', function(){ b2bModal.classList.add('open'); });
      b2bModal.querySelector('.close-b2b').addEventListener('click', function(){ b2bModal.classList.remove('open'); });
      if(window.location.search.indexOf('sent=1') !== -1){ b2bModal.classList.add('open'); }
    }

    // Checkout total calculation
    var subtotalEl = document.getElementById('checkout-subtotal');
    var totalEl = document.getElementById('checkout-total');
    var shippingSelect = document.getElementById('shipping-select');
    function updateTotal(){
      if(!subtotalEl || !totalEl) return;
      var subtotal = parseFloat(subtotalEl.textContent.replace(/\./g,'')) || 0;
      var ship = shippingSelect ? parseFloat(shippingSelect.options[shippingSelect.selectedIndex].dataset.cost) : 0;
      totalEl.textContent = (subtotal + ship).toLocaleString('es-CL');
    }
    if(totalEl){ updateTotal(); }
    if(shippingSelect){ shippingSelect.addEventListener('change', updateTotal); }

    function showToast(msg){
      var container = document.getElementById('toast-container');
      if(!container) return;
      var toast = document.createElement('div');
      toast.className = 'toast';
      toast.textContent = msg;
      container.appendChild(toast);
      setTimeout(function(){
        toast.classList.add('visible');
        setTimeout(function(){
          toast.classList.remove('visible');
          setTimeout(function(){ container.removeChild(toast); }, 300);
        }, 3000);
      }, 10);
    }
  });
})();
