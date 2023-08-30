<template>
    <div class="container">
        <!-- Content here -->
        <div class="row">
            <div class="row">
                <div class="col-md-8 mx-auto mt-5 mb-5">
                    <h3>Импорт пользователей</h3>
                </div>
            </div>
            <template v-if="importUser">
                <button @click.prevent="importUsers" class="btn btn-primary col-md-2" type="submit">
                    Импортировать
                </button>
            </template>

            <template v-if="loading">
                <button class="btn btn-primary col-md-2" type="button" disabled>
                    <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                    Загрузка
                </button>
            </template>

            <div>
                Всего: {{ this.count }}
            </div>

            <div>
                Добавлено: {{ this.created }}
            </div>

            <div>
                Обновлено: {{ this.updated }}
            </div>

        </div>
    </div>

</template>

<script>
export default {
    name: "App",
    data() {
        return {
            count: null,
            created: null,
            updated: null,
            importUser: true,
            loading: false
        }
    },
    methods: {
        importUsers() {
            this.importUser = false
            this.loading = true

            axios.get('http://dropsale/api/users')
                .then(res => {
                    this.count = res.data.count,
                    this.created = res.data.created,
                    this.updated = res.data.updated
                })
                .then(() => {
                    this.importUser = true
                    this.loading = false
                })
        }
    }
}
</script>

<style scoped>

</style>
