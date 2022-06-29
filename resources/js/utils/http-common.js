import axios from 'axios';

// const HTTP = axios s
export const HTTP = axios.create({
    baseURL: process.env.MIX_DOMAIN,
    // baseURL: `http://hrent-aj.herokuapp.com/`,
    // baseURL: `http://rental.local/`,
    headers: {
        Authorization: 'Bearer {token}'
    }
})
