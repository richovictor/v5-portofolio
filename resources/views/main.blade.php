<!DOCTYPE html>
<html lang="en">
<head>
    {{-- head --}}
    @include("layout.head")
    {{-- End Of head --}}
</head>
<body class="index-page">

        {{-- <!-- Loading Start -->
        @component("components.loader")
            Loading....
        @endcomponent
        <!-- Loading End --> --}}

        {{-- Navbar --}}
        @unless(isset($hideNavbar))
        @include("layout.navbar")
        @endunless
        {{-- End Of Navbar --}}

        <main class="main">
            @yield("content")
        </main>

        {{-- Footer --}}
        @unless(isset($hideFooter))
        @include("layout.footer")
        @endunless
        {{-- End Of Footer --}}

        <!-- Scroll Top -->
        <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    {{-- script --}}
    @include("layout.script")
    {{-- End Of script --}}

</body>
</html>
