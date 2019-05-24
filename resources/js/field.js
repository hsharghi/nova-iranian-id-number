Nova.booting((Vue, router) => {
    Vue.component('index-iranian_id_number', require('./components/IndexField'));
    Vue.component('detail-iranian_id_number', require('./components/DetailField'));
    Vue.component('form-iranian_id_number', require('./components/FormField'));
})
