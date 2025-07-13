<!-- 
<title><?= $konfig->judul_website ?></title>

<meta charset="utf-8">
    <link href="<?= base_url('assets/assets/img/logo.png'); ?>" rel="shortcut icon">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="title" content="About Us - PT BINCO RAN NUSANTARA">
<meta name="description" content="PT BINCO RAN NUSANTARA mengolah serabut kelapa menjadi Cocobristel, Cocofiber, dan Cocopeat. Produk inovatif seperti Cocopot, Cocomest, dan Coconet mendukung gaya hidup hijau.">
<meta name="keywords" content="Cocobristel, Cocofiber, Cocopeat, produk ramah lingkungan, serabut kelapa, Cocopot, Cocomest, Coconet, PT BINCO RAN NUSANTARA">
<meta name="author" content="PT BINCO RAN NUSANTARA">
<meta property="og:title" content="About Us - PT BINCO RAN NUSANTARA">
  <meta property="og:description" content="PT BINCO RAN NUSANTARA mengolah serabut kelapa menjadi berbagai produk inovatif yang bermanfaat dan ramah lingkungan.">
  <meta property="og:image" content="https://www.google.com/imgres?q=bincoran&imgurl=https%3A%2F%2Flinktr.ee%2Fog%2Fimage%2FBincoran.jpg&imgrefurl=https%3A%2F%2Flinktr.ee%2FBincoran&docid=tW7Zfz-g7xO9oM&tbnid=oxrf9_LP2I5XrM&vet=12ahUKEwj5w5Gy7KuMAxUlD0QIHcR8JusQM3oECBQQAA..i&w=1200&h=630&hcb=2&ved=2ahUKEwj5w5Gy7KuMAxUlD0QIHcR8JusQM3oECBQQAA">
  <meta property="og:url" content="https://www.google.com/imgres?q=bincoran&imgurl=https%3A%2F%2Flinktr.ee%2Fog%2Fimage%2FBincoran.jpg&imgrefurl=https%3A%2F%2Flinktr.ee%2FBincoran&docid=tW7Zfz-g7xO9oM&tbnid=oxrf9_LP2I5XrM&vet=12ahUKEwj5w5Gy7KuMAxUlD0QIHcR8JusQM3oECBQQAA..i&w=1200&h=630&hcb=2&ved=2ahUKEwj5w5Gy7KuMAxUlD0QIHcR8JusQM3oECBQQAA">
  <meta property="og:type" content="website">
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
        const svgOfActiveBtn = btnToActive.querySelector('.mode-switch use').getAttribute('href')

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

<link rel="shortcut icon" href="<?= base_url('assets/assets/img/logo.png'); ?>">

<link rel="preconnect" href="https://fonts.googleapis.com/">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&amp;family=Roboto:wght@400;500;700&amp;display=swap">

<link rel="stylesheet" type="text/css" href="<?= base_url('assets/assets/vendor/font-awesome/css/all.min.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/assets/vendor/tiny-slider/tiny-slider.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/assets/vendor/glightbox/css/glightbox.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/assets/vendor/choices/css/choices.min.css'); ?>">

<link rel="stylesheet" type="text/css" href="<?= base_url('assets/assets/css/style.css'); ?>"> -->

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