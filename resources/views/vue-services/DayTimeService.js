import {DateTime} from "luxon";

export default class DayTimeService {
    static dayWithTime (day) {
        const dayObject = DateTime.fromISO(day).setLocale('en')
        const date = dayObject.toFormat('dd LLLL, y')
        const time = dayObject.toFormat('hh:mm a')
        return `${date} at ${time}`
    }
}
