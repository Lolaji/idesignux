export default {
    methods: {
        axiosErrorLog(err) {
            if (err.response)
                console.error(err.response.data.message);
        }
    }
}