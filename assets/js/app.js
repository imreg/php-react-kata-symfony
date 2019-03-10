import React from 'react';
import ReactDOM from 'react-dom';
import QuotaTable from './Components/QuotaTable';
import QuotaAddNew from './Components/QuotaAddNew'

class App extends React.Component {
    render() {
        return (
            <div>
                <QuotaTable/>
                <QuotaAddNew/>
            </div>
    )
        ;
    }
}

ReactDOM.render(<App/>, document.getElementById('root'));
