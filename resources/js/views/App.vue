<template>
    <div>
        <div>
            <section class="content-header">
                <h1>{{ this.$parent.section }}</h1><br>
            </section>
            <section class="content">
                <router-view></router-view>
            </section>
        </div>
    </div>
</template>
<script>
    export default {        
        created(){
            this.$router.push(window.location.pathname);
            this.$router.beforeEach((to, from, next) => {
                const destino = to.name;
                if(destino=='AuxiliarTerminalListaEstudiantesClase')
                {
                    $('.modal').modal('hide');
                    next();
                }
                else if($(".modal").is(':visible'))
                {
                    $('.modal').modal('hide');
                    next(false);
                }
                else
                    next();
            });
        },
    }
</script>