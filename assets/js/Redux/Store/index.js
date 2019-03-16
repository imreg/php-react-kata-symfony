// src/js/store/index.js

import {createStore,compose, applyMiddleware} from "redux";
import rootReducer from "../Reducers/index";
import thunkMiddleware from 'redux-thunk';

export default function configureStore(initialState) {
    const middewares = [
        // Add other middleware on this line...

        // thunk middleware can also accept an extra argument to be passed to each thunk action
        // https://github.com/gaearon/redux-thunk#injecting-a-custom-argument
        thunkMiddleware,
    ];
    const store = createStore(rootReducer, initialState, compose(
        applyMiddleware(...middewares),
        window.devToolsExtension ? window.devToolsExtension() : f => f // add support for Redux dev tools
        )
    );

    if (module.hot) {
        // Enable Webpack hot module replacement for reducers
        module.hot.accept('../Reducers/index', () => {
            const nextReducer = require('../Reducers/index').default; // eslint-disable-line global-require
            store.replaceReducer(nextReducer);
        });
    }

    return store;
}
//export default store;