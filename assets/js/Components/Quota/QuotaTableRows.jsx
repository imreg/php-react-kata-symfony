import React, { Component } from "react";
import TableCell from '@material-ui/core/TableCell';
import TableRow from '@material-ui/core/TableRow';
import Switch from '@material-ui/core/Switch';
import CurrencyFormat from 'react-currency-format';
import dateFormat from 'dateformat';
import PropTypes from "prop-types";

class QuotaTableRows extends Component {

    amount(premiumAmount) {
        if (premiumAmount > 0) {
            premiumAmount = this.props.obj.premiumAmount / 100;
        }
        return <CurrencyFormat
            value={premiumAmount}
            displayType={'text'}
            thousandSeparator={true}
            prefix={'£'}
        />;
    }

    render() {
        return (
            <TableRow key={this.props.obj.id}>
                <TableCell component="th" scope="row">
                <Switch
                    value="checkedC"
                    color="primary"
                />
                </TableCell>
                <TableCell component="th" scope="row">
                    {this.props.obj.id}
                </TableCell>
                <TableCell component="th" align="right">
                    {this.props.obj.referenceNumber}
                </TableCell>
                <TableCell component="th" align="right">
                    {this.props.obj.description}
                </TableCell>
                <TableCell component="th" align="right">
                    {this.amount(this.props.obj.premiumAmount)}
                </TableCell>
                <TableCell component="th" align="right">
                    {dateFormat(this.props.obj.dateCreated, "yyyy-dd-mm, HH:MM:ss")}
                </TableCell>
            </TableRow>
        );
    }
}

export default QuotaTableRows;
