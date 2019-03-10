import React from 'react';
import axios from 'axios';
import Input from '@material-ui/core/Input';
import InputLabel from '@material-ui/core/InputLabel';
import Button from '@material-ui/core/Button';
import FormControl from '@material-ui/core/FormControl';

const styles = theme => ({
    container: {
        display: 'flex',
        flexWrap: 'wrap',
    },
    input: {
        margin: theme.spacing.unit,
    },
    button: {
        margin: theme.spacing.unit,
    },
    margin: {
        margin: theme.spacing.unit,
    },
    cssLabel: {
        '&$cssFocused': {
            color: purple[500],
        },
    },
    cssFocused: {},
    cssUnderline: {
        '&:after': {
            borderBottomColor: purple[500],
        },
    }
});

class QuotaAddNew extends React.Component {

    constructor(props) {
        super(props);

        this.onChangeReferenceNumber = this.onChangeReferenceNumber.bind(this);
        this.onChangePremiumAmount = this.onChangePremiumAmount.bind(this);
        this.onChangeDescription = this.onChangeDescription.bind(this);
        this.onSubmit = this.onSubmit.bind(this);

        this.state = {
            referenceNumber: null,
            description: null,
            premiumAmount: null
        }
    }

    onChangeReferenceNumber(e) {
        this.setState({
            referenceNumber: e.target.value
        });
    }

    onChangeDescription(e) {
        this.setState({
            description: e.target.value
        });
    }

    onChangePremiumAmount(e) {
        this.setState({
            premiumAmount: e.target.value
        });
    }

    onSubmit(e) {
        e.preventDefault();
        const dataset = {
            referenceNumber: this.state.referenceNumber,
            description: this.state.description,
            premiumAmount: this.state.premiumAmount,
        };

        axios.post('/api/create', dataset)
            .then(res => console.log(res.data));

        this.setState({
            referenceNumber: null,
            description: null,
            premiumAmount: null,
            state: this.state
        });
    }

    render() {
        return (
            <div className={styles.container}>
                <h3>New Item</h3>
                <form>
                    <FormControl className={styles.margin}>
                        <InputLabel
                            htmlFor="custom-css-standard-input"
                            classes={{
                                root: styles.cssLabel,
                                focused: styles.cssFocused,
                            }}
                        >
                            Reference Number
                        </InputLabel>
                        <Input
                            id="custom-css-standard-input"
                            classes={{
                                underline: styles.cssUnderline,
                            }}
                            onChange={this.onChangeReferenceNumber}
                        />
                    </FormControl>
                    <FormControl className={styles.margin}>
                        <InputLabel
                            htmlFor="custom-css-standard-input"
                            classes={{
                                root: styles.cssLabel,
                                focused: styles.cssFocused,
                            }}
                        >
                            Description
                        </InputLabel>
                        <Input
                            id="custom-css-standard-input"
                            classes={{
                                underline: styles.cssUnderline,
                            }}
                            onChange={this.onChangeDescription}
                        />
                    </FormControl>
                    <FormControl className={styles.margin}>
                        <InputLabel
                            htmlFor="custom-css-standard-input"
                            classes={{
                                root: styles.cssLabel,
                                focused: styles.cssFocused,
                            }}
                        >
                            Premium Amount
                        </InputLabel>
                        <Input
                            id="custom-css-standard-input"
                            classes={{
                                underline: styles.cssUnderline,
                            }}
                            onChange={this.onChangePremiumAmount}
                        />
                    </FormControl>
                    <Button variant="contained" size="small" color="primary"
                            className={styles.button}
                            onClick={this.onSubmit}>
                        Add
                    </Button>
                </form>
            </div>
        );
    }
}

export default QuotaAddNew;
