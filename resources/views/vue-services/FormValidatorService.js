import {DateTime} from "luxon";

export default class FormValidatorService {
    static validateForm(formData) {
        const errors = []
        if (formData.label.length === 0) {
            errors.push({
                field: 'label',
                reason: 'empty'
            })
        }
        const dateRegex = /^\d{2}\s.{3},\s\d{4}\sat\s\d{2}:\d{2}\s[AP]M$/
        if (formData.date.length === 0) {
            errors.push({
                field: 'date',
                reason: 'empty'
            })
        } else if (formData.date.match(dateRegex) === null) {
            errors.push({
                field: 'date',
                reason: 'date_format'
            })
        } else {
            const modifiedDate = formData.date.replace('at ', '')
            const dateObject = DateTime.fromFormat(modifiedDate, 'dd LLL, y hh:mm a')
            if (!dateObject.isValid) {
                errors.push({
                    field: 'date',
                    reason: 'invalid'
                })
            }
        }
        const amountRegex = /^-?\d+(\.\d{2})?$/
        if (formData.amount.length === 0 || formData.amount === 0) {
            console.log(formData.amount)
            errors.push({
                field: 'amount',
                reason: 'empty'
            })
        } else if (formData.amount.match(amountRegex) === null) {
            errors.push({
                field: 'amount',
                reason: 'money_format'
            })
        }
        return errors
    }
}
