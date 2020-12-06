<template>
    <div class="container">
                <router-link :to="{ name: 'home' }" class="navbar-brand"></router-link>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    
}

</script>