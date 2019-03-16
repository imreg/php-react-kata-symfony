// index.js

import axios from "axios";
import {FETCH_POST, ADD_POST} from "../Constants/types";

export const fetchRecords = (payload) => {
    return {
        type: FETCH_POST,
        payload
    }
};

export const fetchAllRecords = () => {
    return (dispatch) => {
        return axios.get('/api/all')
            .then(response => {
                dispatch(fetchRecords(response.data))
            })
            .catch(function (error) {
                throw (error);
            })
    }
};

export const addRecordSuccess = (payload) => {
    return {
        type: ADD_POST,
        payload
    }
};

export const addRecord = (dataset) => {
    return (dispatch) => {
        return  axios.post('/api/create', dataset)
            .then(response => {
                dispatch(addRecordSuccess(response.data))
            })
            .catch(function (error) {
                throw (error);
            });
    }
};