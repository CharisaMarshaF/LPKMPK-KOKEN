
<!DOCTYPE html>


<html lang="en">

<head>
    <title>LPK MPK-KOKEN - Pelatihan dan Penyaluran Kerja ke Jepang</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="LPK MPK-KOKEN">
    <meta name="description"
        content="LPK MPK-KOKEN adalah lembaga pelatihan kerja profesional yang menyediakan program magang, engineering, dan tokutei ginou ke Jepang. Bimbingan intensif dan jalur penyaluran resmi.">
  <!-- Open Graph (for social media preview) -->
  <meta property="og:title" content="LPK MPK-KOKEN - Pelatihan dan Penyaluran Kerja ke Jepang" />
  <meta property="og:description" content="LPK MPK-KOKEN menyediakan program pelatihan magang, engineering, dan tokutei ginou ke Jepang. Bimbingan intensif dan jalur resmi." />
  <meta property="og:image" content="<?= base_url('assets/assets/img/logo.png'); ?>" />
  <meta property="og:url" content="<?= base_url(); ?>" />
  <meta property="og:type" content="website" />
    <!-- Favicon -->
    <link rel="icon" href="<?= base_url('assets/assets/img/logo.png'); ?>" type="image/x-icon">

    <!-- Dark mode -->
    <meta name="color-scheme" content="light dark">

    <script>
        const storedTheme = localStorage.getItem('theme')

        const getPreferredTheme = () => {
            if (storedTheme) {
                return storedTheme
            }
            return window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'light'
        }

        const setTheme = function (theme) {
            if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                document.documentElement.setAttribute('data-bs-theme', 'dark')
            } else {
                document.documentElement.setAttribute('data-bs-theme', theme)
            }
        }

        setTheme(getPreferredTheme())

        window.addEventListener('DOMContentLoaded', () => {
            var el = document.querySelector('.theme-icon-active');
            if (el != 'undefined' && el != null) {
                const showActiveTheme = theme => {
                    const activeThemeIcon = document.querySelector('.theme-icon-active use')
                    const btnToActive = document.querySelector(`[data-bs-theme-value="${theme}"]`)
                    const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute(
                        'href')

                    document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
                        element.classList.remove('active')
                    })

                    btnToActive.classList.add('active')
                    activeThemeIcon.setAttribute('href', svgOfActiveBtn)
                }

                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                    if (storedTheme !== 'light' || storedTheme !== 'dark') {
                        setTheme(getPreferredTheme())
                    }
                })

                showActiveTheme(getPreferredTheme())

                document.querySelectorAll('[data-bs-theme-value]')
                    .forEach(toggle => {
                        toggle.addEventListener('click', () => {
                            const theme = toggle.getAttribute('data-bs-theme-value')
                            localStorage.setItem('theme', theme)
                            setTheme(theme)
                            showActiveTheme(theme)
                        })
                    })

            }
        })
    </script>
<!-- Favicon -->
<link rel="shortcut icon" href="<?= base_url('assets/assets/img/logo.png'); ?>">

<!-- Google Font -->
<link rel="preconnect" href="https://fonts.googleapis.com/">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap">

<!-- Plugins CSS -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/assets/vendor/font-awesome/css/all.min.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/assets/vendor/glightbox/css/glightbox.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/assets/vendor/choices/css/choices.min.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/assets/vendor/tiny-slider/tiny-slider.css'); ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.min.css" />

<!-- Theme CSS -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/assets/css/style.css'); ?>">
</head>