<template>
    <div class="flex flex-col flex-1 h-screen overflow-y-hidden">
        <Nav />

        <div class="flex overflow-y-hidden flex-1">
            <SideBar />
            <div class="overflow-x-hidden w-2/3">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import Nav from "./Nav.vue";
import SideBar from "./SideBar.vue";

export default {
    name: "App",

    components: {
        Nav,
        SideBar,
    },
};
</script>

<style scoped></style>
