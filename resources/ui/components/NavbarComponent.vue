<template>
    <nav class="d-flex align-items-center">
        <div>
            <h1 class="d-none d-md-block">SeamlessHr</h1>
            <h1 class="d-block d-md-none">SHr</h1>
        </div>
        <div class="mx-auto"></div>
        <div>
            <button class="btn"><BIconBell /></button>
            <button class="btn"><BIconEnvelope /></button>
            <button @click="logoutOut" class="btn"><BIconPower /></button>
        </div>
    </nav>
</template>

<script>
import { mapActions, mapState } from "vuex";
import {logoutUser} from "@ui/http/user.api";
import { BIconPower, BIconBell, BIconEnvelope } from "bootstrap-vue";
export default {
    name: "NavbarComponent",
    components: { BIconPower, BIconBell, BIconEnvelope },
    computed: {
        ...mapState("User", ["user"])
    },

    methods: {
        ...mapActions("User", ["loadUser"]),
        logoutOut() {
            if(confirm("You are about to logout!")){
                logoutUser().then(({status}) => {
                    if(status !== 204) throw new Error("Logout operation failed!");
                    window.location.reload();
                })
                .catch(error => {
                    alert(error.message);
                });
            }
        }
    },
    created() {
        this.loadUser();
    }
};
</script>

<style lang="scss" scoped>
nav {
    padding: 0.6rem 1.5rem;
    border-bottom-left-radius: 0 !important;
    border-bottom-right-radius: 0 !important;
    background-color: #ffffff;
}
</style>
