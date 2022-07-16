import store from '../store/index';


export default {

    methods: {
        business: (key) => {
            const settings = store.getters.settings.data;
            return settings[0].includes(key)
        },
    },
};
