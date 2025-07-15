<!-- <div class="back-top"><i class="bi bi-arrow-up-short position-absolute top-50 start-50 translate-middle"></i>
		</div>

		<script src="<?= base_url('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script>

		<script src="<?= base_url('assets/assets/vendor/tiny-slider/tiny-slider.js'); ?>"></script>
		<script src="<?= base_url('assets/assets/vendor/glightbox/js/glightbox.js'); ?>"></script>
        <script src="<?= base_url('assets/vendor/choices/js/choices.min.js'); ?>"></script>

		<script src="<?= base_url('assets/assets/js/functions.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tns({
                container: '.tiny-slider-inner',
                items: 4,
                slideBy: 1,
                autoplay: true,
                autoplayButtonOutput: false,
                controls: false,
                nav: false,
                gutter: 20,
                mouseDrag: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    576: {
                        items: 2
                    },
                    992: {
                        items: 3
                    },
                    1200: {
                        items: 3
                    }
                }
            });
        });
    </script> -->

	
<!-- Bootstrap JS -->
 <!-- WhatsApp Bubble -->
<div class="wa-bubble" onclick="toggleWAChat()">
    <i class="bi bi-whatsapp"></i>
</div>

<!-- Chatbox -->
<div class="wa-chatbox" id="waChat">
    <h5><i class="bi bi-chat-dots"></i> Pilih Nomor WhatsApp</h5>

    <!-- Step 1: Pilih Nomor WhatsApp -->
    <div id="waStep1">
        <?php
            $row = $this->db->get_where('social_media', ['id' => 1])->row();
            for ($i = 1; $i <= 3; $i++) {
                $wa = "whatsapp_$i";
                $nama = "nama_wa$i";
                if (!empty($row->$wa)) {
                    $number = preg_replace('/[^0-9]/', '', $row->$wa);
                    echo '<div class="wa-option" onclick="selectWA(\'' . $number . '\', \'' . htmlspecialchars($row->$nama) . '\')">
                        <i class="bi bi-whatsapp"></i> ' . htmlspecialchars($row->$nama) . ' (' . $row->$wa . ')
                    </div>';
                }
            }
        ?>
    </div>

    <!-- Step 2: Form Kirim Pesan -->
    <div id="waStep2" style="display:none;">
        <p style="font-size:14px; margin-bottom:10px;">
            Mengirim ke: <strong id="selectedWaName"></strong>
        </p>
        <input type="text" id="waName" placeholder="Nama Anda">
        <textarea id="waMessage" rows="3" placeholder="Tulis pesan Anda..."></textarea>
        <button onclick="sendWA()">Kirim ke WhatsApp</button>
    </div>
</div>

<!-- Styles -->
<style>
.wa-bubble {
    position: fixed;
    bottom: 20px;
    left: 20px;
    background: linear-gradient(135deg, #25D366, #1ebe5d);
    width: 60px;
    height: 60px;
    color: white;
    border-radius: 50%;
    font-size: 28px;
    text-align: center;
    line-height: 60px;
    z-index: 1001;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease;
    cursor: pointer;
}
.wa-bubble:hover {
    transform: scale(1.1);
}

.wa-chatbox {
    position: fixed;
    bottom: 90px;
    left: 20px;
    width: 320px;
    background: #f9fdfb;
    border: 1px solid #e0f1e8;
    border-left: 6px solid #25D366;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    z-index: 1000;
    display: none;
    animation: fadeInUp 0.3s ease;
}
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
}

.wa-chatbox h5 {
    font-size: 16px;
    font-weight: 600;
    color: #1c1c1c;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
}

.wa-chatbox h5 i {
    margin-right: 6px;
    color: #25D366;
}

.wa-option {
    background-color: #eafff2;
    padding: 10px;
    margin-bottom: 8px;
    border-radius: 8px;
    cursor: pointer;
    border: 1px solid #b7efcc;
    transition: background 0.2s;
    font-size: 14px;
}
.wa-option:hover {
    background-color: #d6f7e4;
}

.wa-chatbox input,
.wa-chatbox textarea {
    width: 100%;
    border: 1px solid #dcdcdc;
    border-radius: 8px;
    padding: 8px 10px;
    font-size: 14px;
    margin-bottom: 12px;
    background-color: #fff;
    color: #333;
    transition: border 0.3s;
}
.wa-chatbox input::placeholder,
.wa-chatbox textarea::placeholder {
    color: #888;
}
.wa-chatbox input:focus,
.wa-chatbox textarea:focus {
    outline: none;
    border-color: #25D366;
    box-shadow: 0 0 0 2px rgba(37, 211, 102, 0.2);
}
.wa-chatbox button {
    background-color: #25D366;
    color: white;
    border: none;
    width: 100%;
    padding: 10px;
    font-size: 14px;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s;
}
.wa-chatbox button:hover {
    background-color: #1ebe5d;
}
</style>

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- JavaScript -->
<script>
let selectedNumber = '';
let selectedName = '';

function toggleWAChat() {
    const box = document.getElementById("waChat");
    box.style.display = (box.style.display === "block") ? "none" : "block";

    // Reset to step 1 when chatbox is reopened
    document.getElementById("waStep1").style.display = "block";
    document.getElementById("waStep2").style.display = "none";
}

function selectWA(number, name) {
    selectedNumber = number;
    selectedName = name;
    document.getElementById("selectedWaName").innerText = name;
    document.getElementById("waStep1").style.display = "none";
    document.getElementById("waStep2").style.display = "block";
}

function sendWA() {
    const name = document.getElementById("waName").value.trim();
    const message = document.getElementById("waMessage").value.trim();

    if (!name || !message || !selectedNumber) {
        alert("Mohon isi nama, pesan, dan pilih tujuan WhatsApp.");
        return;
    }

    const text = `Halo Admin,\nSaya ${name},\n${message}`;
    const encodedText = encodeURIComponent(text);
    const url = `https://wa.me/${selectedNumber}?text=${encodedText}`;
    window.open(url, '_blank');
}
</script>
<script src="<?= base_url('assets/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script>

<!-- Vendors -->
<script src="<?= base_url('assets/assets/vendor/glightbox/js/glightbox.js'); ?>"></script>
<script src="<?= base_url('assets/assets/vendor/choices/js/choices.min.js'); ?>"></script>

<!-- Template Functions -->
<script src="<?= base_url('assets/assets/js/functions.js'); ?>"></script>
<script src="<?= base_url('assets/assets/vendor/tiny-slider/tiny-slider.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            tns({
                container: '.tiny-slider-inner',
                items: 4,
                slideBy: 1,
                autoplay: true,
                autoplayButtonOutput: false,
                controls: false,
                nav: false,
                gutter: 20,
                mouseDrag: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    576: {
                        items: 2
                    },
                    992: {
                        items: 3
                    },
                    1200: {
                        items: 3
                    }
                }
            });
        });
    </script>

</body>


</html>
