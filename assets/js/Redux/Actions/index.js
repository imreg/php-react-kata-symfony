// index.js

import axios from "axios";
import {FETCH_POST, ADD_POST, DATA_REQUESTED} from "../Constants/types";

export const fetchRecords = (payload) => {
    return {
        type: FETCH_POST,
        payload
    }
};


export const addRecordSuccess = (payload) => {
    return {
        type: ADD_POST,
        payload
    }
};

export const getData = () => {
    return {
        type: DATA_REQUESTED
    };
}

export const fetchAllRecords = () => {
    return (dispatch) => {
        return axios.get('/api/quotes')
            .then(response => {
                dispatch(fetchRecords(response.data))
            })
            .catch(function (error) {
                throw (error);
            })
    }
};

export const addRecord = (dataset) => {
    return (dispatch) => {
        return  axios.post('/api/quotes', dataset)
            .then(response => {
                dispatch(addRecordSuccess(response.data))
            })
            .catch(function (error) {
                throw (error);
            });
    }
};
