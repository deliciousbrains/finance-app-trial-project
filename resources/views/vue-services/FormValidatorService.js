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
        const dateRegex = /^\d{2}\s{3},\s\d{4}\sat\s\d{2}:\d{2}\s[AP]M$/
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
            const modifiedDate = formData.date.replace('at ', '').replace(',', '')
            const dateObject = DateTime.fromRFC2822(modifiedDate)
            if (!dateObject.isValid) {
                errors.push({
                    field: 'date',
                    reason: 'invalid'
                })
            }
        }
        const amountRegex = /^-?\d+(\.\d{2})?$/
        if (formData.amount.length === 0) {
            errors.push({
                field: 'value',
                reason: 'empty'
            })
        } else if (formData.date.match(amountRegex) === null) {
            errors.push({
                field: 'value',
                reason: 'money_format'
            })
        }
        return errors
    }
}
