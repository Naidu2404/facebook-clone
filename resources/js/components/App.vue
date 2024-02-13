<template>
    <div>
        Start

        <router-view></router-view>
    </div>
</template>

<script>
import router from "../router";

export default {
    name: "App",
    components: { router },
};
</script>

<style scoped></style>
