// Main JavaScript for Ecohierbas theme
(function(){
  document.addEventListener('DOMContentLoaded', function(){
    // Mobile menu toggle
    var toggle = document.querySelector('.menu-toggle');
    var mobileMenu = document.getElementById('mobile-menu');
    var overlay = document.querySelector('.menu-overlay');
    var closeBtn = mobileMenu ? mobileMenu.querySelector('.close-menu') : null;

    function closeMenu(){
      mobileMenu.classList.remove('open');
      overlay && overlay.classList.remove('open');
      toggle.setAttribute('aria-expanded', 'false');
      mobileMenu.setAttribute('aria-hidden', 'true');
      document.body.classList.remove('no-scroll');
    }

    if (toggle && mobileMenu) {
      toggle.addEventListener('click', function () {
        var expanded = toggle.getAttribute('aria-expanded') === 'true';
        if(expanded){
          closeMenu();
        }else{
          toggle.setAttribute('aria-expanded', 'true');
          mobileMenu.classList.add('open');
          overlay && overlay.classList.add('open');
          mobileMenu.setAttribute('aria-hidden', 'false');
          document.body.classList.add('no-scroll');
        }
      });
      if(closeBtn){
        closeBtn.addEventListener('click', closeMenu);
      }
      if(overlay){
        overlay.addEventListener('click', closeMenu);
      }
      mobileMenu.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', closeMenu);
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

    function saveCart(items){
      try{ localStorage.setItem('ec_cart', JSON.stringify(items)); }catch(e){}
    }
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
      saveCart(items);
    }
    if(typeof ecohierbas !== 'undefined'){
      cartCount.textContent = ecohierbas.cartCount || 0;
      var items = ecohierbas.cartItems || [];
      if(!items.length){
        var stored = localStorage.getItem('ec_cart');
        if(stored){
          try{
            var arr = JSON.parse(stored);
            arr.forEach(function(it){
              var body = 'action=ecohierbas_add_to_cart&product_id=' + it.id + '&quantity=' + it.qty + '&_ajax_nonce=' + ecohierbas.nonce;
              fetch(ecohierbas.ajaxurl, {method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, body:body});
            });
            items = arr;
          }catch(e){}
        }
      }
      renderCart(items);
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
    var activeCat = 'all';
    var searchTerm = '';
    var minPrice = 0;
    var maxPrice = Infinity;

    function applyFilters(){
      productCards.forEach(function(card){
        var catOk = (activeCat === 'all' || card.getAttribute('data-cat').split(' ').includes(activeCat));
        var title = card.getAttribute('data-title').toLowerCase();
        var searchOk = title.indexOf(searchTerm) !== -1;
        var price = parseFloat(card.getAttribute('data-price')) || 0;
        var priceOk = price >= minPrice && price <= maxPrice;
        card.style.display = (catOk && searchOk && priceOk) ? 'block' : 'none';
      });
    }

    filterButtons.forEach(function(btn){
      btn.addEventListener('click', function(){
        filterButtons.forEach(function(b){ b.classList.remove('active'); });
        btn.classList.add('active');
        activeCat = btn.getAttribute('data-cat');
        applyFilters();
      });
    });

    var searchInput = document.getElementById('product-search');
    if(searchInput){
      searchInput.addEventListener('input', function(){
        searchTerm = searchInput.value.toLowerCase();
        applyFilters();
      });
    }

    var applyPrice = document.getElementById('apply-price');
    if(applyPrice){
      applyPrice.addEventListener('click', function(){
        minPrice = parseFloat(document.getElementById('min-price').value) || 0;
        maxPrice = parseFloat(document.getElementById('max-price').value) || Infinity;
        applyFilters();
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
