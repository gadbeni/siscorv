<template>
    <div id="app">
        <OrgChart />
    </div>
</template>

<script>
    import OrgChart from '../../components/OrgChart.vue'

    export default {
        name: 'app',
        components: {
            OrgChart,
        }
    }
</script>

<style scoped>
    #app {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        margin-top: 60px;
    }

    html, body {
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
        overflow: hidden;
        font-family: Helvetica;
    }

    #tree {
        width: 100%;
        height: 100%;
    }
</style>