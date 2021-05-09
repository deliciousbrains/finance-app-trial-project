import {DateTime} from "luxon";

export default class DayTimeService {
    static dayWithTime(day) {
        let dayObject
        if (day) {
            dayObject = DateTime.fromISO(day).setLocale('en')
        } else {
            dayObject = DateTime.now().setLocale('en')
        }
        const date = dayObject.toFormat('dd LLL, y')
        const time = dayObject.toFormat('hh:mm a')
        return `${date} at ${time}`
    }

    static getSQLDate(date) {
        const modifiedDate = date.replace('at ', '')
        const dateObject = DateTime.fromFormat(modifiedDate, 'dd LLL, y hh:mm a')
        return dateObject.toSQL()
    }
}
