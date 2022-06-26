import axios from 'axios';

// const HTTP = axios s
export const HTTP = axios.create({
    baseURL: `http://hrent-aj.herokuapp.com/`,
    // baseURL: `http://rental.local/`,
    // baseURL: `http://rent.local/`,
    // baseURL: `https://afchms.cerebrum.host/`,
    headers: {
        Authorization: 'Bearer {token}'
    }
})
