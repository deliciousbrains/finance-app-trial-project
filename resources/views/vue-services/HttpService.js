import axios from 'axios'

const token = 'token'

export default class HttpService {
    static makeRequest (method, url) {
        return axios.request({
            method: method,
            url: url,
            headers: {
                'Authorization': 'Bearer ' + token
            }
        })
    }
}
