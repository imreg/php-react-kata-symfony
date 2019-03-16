import {FETCH_POST,ADD_POST} from "../Constants/types";

const initialState = {
    records: []
};

function rootReducer(state = initialState, action) {
    switch (action.type) {
        case FETCH_POST:
            return Object.assign({}, state, {
                  records: state.records.concat(action.payload)
            });
        case ADD_POST:
            return Object.assign({}, state, {
                records: state.records.concat(action.payload)
            });
        default:
            return state;
    }
}

export default rootReducer;