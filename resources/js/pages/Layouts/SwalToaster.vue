<template>
</template>

<script>
export default {
    name: "SwalToaster",
    mounted() {
        if(this.$page.props.flash.type!=''){
            this.$swal({
                position: 'top-end',
                toast: true,
                icon: this.$page.props.flash.type,
                title:this.$page.props.flash.type,
                html: this.$page.props.flash.message,
                timer: 8000,
                timerProgressBar: true,
                showConfirmButton: false,
                showCloseButton:true
            });
        }
    }
}
</script>

<style scoped>

</style>
