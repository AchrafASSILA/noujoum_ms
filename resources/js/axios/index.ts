import axios from "axios";

const axiosClient = axios.create({
    baseURL: "/api",
});

axiosClient.interceptors.request.use((config) => {
    config.headers.Authorization = `Bearer ${localStorage.getItem("TOKEN")}`;
    return config;
});
axiosClient.defaults.headers.post["content-type"] = "multipart/form-data";
axiosClient.defaults.headers.common["x-api-key"] =
    "wmwQcLsQljWyuBT6j4qYZeDaJcICaCa5SpG90rKsTPDMaLIwQamKPpdnK3vvjc1V";



let get = (url: string, param: any, data: any) => {
    axiosClient.get(url + param, data).then((res: any) => {
        return res
    }).catch(err => {
        return err
    })
}
let post = (url: string, param: any, data: any) => {

}


// export default {axiosClient , get , post} ; 
export default axiosClient ;