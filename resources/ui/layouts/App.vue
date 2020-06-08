<template>
    <div id="wrapper" class="shadow">
        <header>
            <NavbarComponent />
        </header>
        <main>
            <router-view />
        </main>
    </div>
</template>

<script>
import NavbarComponent from "@ui/components/NavbarComponent";
export default {
    name: "App",
    components: {
        NavbarComponent
    }

}
</script>
