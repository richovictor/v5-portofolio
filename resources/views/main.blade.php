<!DOCTYPE html>
<html lang="en">
<head>
    {{-- head --}}
    @include("layout.head")
    {{-- End Of head --}}
</head>
<body class="index-page">
    <div id="loader-overlay" style="display: none;">
        <div class="loader-spinner"></div>
    </div>
    
    {{-- <!-- Loading Start -->
    @component("components.loader")
    Loading....
    @endcomponent
    <!-- Loading End --> --}}
    {{-- Navbar --}}
    
    @unless(isset($hideNavbar) && $hideNavbar)
    @include("layout.navbar")
    @endunless
    {{-- End Of Navbar --}}
    
    <main class="main">
        @yield("content")
    </main>

    {{-- Footer --}}
    @unless(isset($hideFooter) && $hideFooter)
    @include("layout.footer")
    @endunless
    {{-- End Of Footer --}}

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    {{-- script --}}
    @include("layout.script")
    {{-- End Of script --}}
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                setTimeout(() => {
                    flashMessage.classList.remove('show');
                    flashMessage.classList.add('hide');
                }, 3000); // 3 detik
            }
        });
    </script>   

    @stack('scripts') 

</body>
</html>
