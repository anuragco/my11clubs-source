@props(['bannerUrl'])

<div id="popupBanner" class="popup-banner">
    <div class="popup-content">
        <span class="close-btn" onclick="closePopupBanner()">&times;</span>
        <img src="{{ $bannerUrl }}" frameborder="0" class="banner-iframe"></iframe>
    </div>
</div>

<script>
    function closePopupBanner() {
        document.getElementById('popupBanner').style.display = 'none';
    }
</script>

<style>
    .popup-banner {
        display: block;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.5);
        overflow: hidden; /* Ensure no scrollbars outside the popup */
    }

    .popup-content {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 80%;
        height: 80%;
        max-width: 90vw; /* Limit maximum width */
        max-height: 90vh; /* Limit maximum height */
        overflow: hidden; /* Hide any overflow */
    }

    .close-btn {
        color: #aaa;
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
        z-index: 9999; /* Ensure close button is above everything */
    }

    .close-btn:hover,
    .close-btn:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .banner-iframe {
        width: 100%;
        height: 100%;
        border: none;
        object-fit: contain; /* Ensures the image fits within the iframe without distortion */
    }
</style>
