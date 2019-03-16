import React, { Component } from "react";
import TableCell from '@material-ui/core/TableCell';
import TableRow from '@material-ui/core/TableRow';
import CurrencyFormat from 'react-currency-format';
import dateFormat from 'dateformat';

class QuotaTableRows extends Component {
    constructor() {
        super();
    }

    amount(premiumAmount) {
        if (premiumAmount > 0) {
            premiumAmount = this.props.obj.premiumAmount / 100;
        }
        return <CurrencyFormat value={premiumAmount} displayType={'text'} thousandSeparator={true} prefix={'£'}/>;
    }


    render() {
        return (
            <TableRow key={this.props.obj.id}>
                <TableCell component="th" scope="row">
                    {this.props.obj.id}
                </TableCell>
                <TableCell align="right">
                    {this.props.obj.referenceNumber}
                </TableCell>
                <TableCell align="right">
                    {this.props.obj.description}
                </TableCell>
                <TableCell align="right">
                    {this.amount(this.props.obj.premiumAmount)}
                </TableCell>
                <TableCell align="right">
                    {dateFormat(this.props.obj.dateCreated, "yyyy-dd-mm, HH:MM:ss")}
                </TableCell>
            </TableRow>
        );
    }
}

export default QuotaTableRows;
