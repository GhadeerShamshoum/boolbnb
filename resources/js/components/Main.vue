<template>
    <main>
        <router-view :apartmentList=apartmentList :key="$route.path"></router-view>
    </main>
</template>

<script>
export default {
    name: "Main",
    props:{
        apartmentList: Array
    }
};
</script>

<style lang="scss" scoped>

</style>