<div class="hero_area">
  <!-- header section strats -->
  <?php include('layout/header.php'); ?>
  <!-- end header section -->

</div>
<!-- end hero area -->

<!-- contact section -->

<section class="contact_section pt-5 mt-5">
  <div class="container px-0">
    <div class="heading_container ">
      <h2 class="">
        Địa chỉ
      </h2>
    </div>
  </div>
  <div class="container container-bg">
    <div class="row">
      <div class="col-lg-7 col-md-6 px-0">
        <div class="map_container">
          <div class="map-responsive">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.870980850469!2d105.76679027484614!3d10.02750409007933!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0883b50699343%3A0x476da3e46bef558f!2zSOG6u20gNDMgMyBUaMOhbmcgMiwgWHXDom4gS2jDoW5oLCBOaW5oIEtp4buBdSwgQ-G6p24gVGjGoSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1726799242510!5m2!1svi!2s"
              width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-5 px-0">
        <form action="index.php?act=contact" method="post">
          <div>
            <input type="text" placeholder="Tên" name="fullname_mess" required />
          </div>
          <div>
            <input type="email" placeholder="Email" name="email_mess" required />
          </div>
          <div>
            <input type="text" placeholder="Số điện thoại" name="phone_mess" required />
          </div>
          <div>
            <input type="text" class="message-box" placeholder="Tin nhắn" name="message" required />
          </div>
          <div class="d-flex ">
            <button type="submit" name="message_send">Gửi lời nhắn</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>


<!-- end contact section -->

<!-- info section -->

<?php include('layout/footer.php'); ?>

<!-- end info section -->