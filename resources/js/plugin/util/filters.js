

import moment from 'moment';

const StringFilters =  {
    slug: value => _.replace(value, / /g, '-'),
    unslug: value => _.replace(value, /-/g, ' '),
    titleCase: value => _.startCase(_.toLower(value)),
    toUpper: value => _.toUpper(value),
    toLower: value => _.toLower(value),
    msgDate: value => {
        let date = moment(value),
            now = moment(_.now());
        
        if (now.year() > date.year()) {
            return data.format('l');
        } else {
            if (now.month() <= date.month()) {
                if (now.day() <= date.day()) {
                    return date.format('h:mm a');
                } else {
                    return date.format('ddd h:mm a');
                }
            } else {
                return date.format('MMM D')
            }
        }
    },
    dateFormat: (value, formatString) => {
        let date = moment(value);
        return date.format(formatString);
    },
    limit: (value, limit = 30, omission = '...') => _.truncate(value, { length: limit, separator: / /, omission: omission }),
    getImageUrl: (value, name, defaultImage = '') => {
        try {
            if (!_.isArray(value)) {
                throw `Error: value to vue filter (getImageUrl) must be an array, ${typeof(value)} given.`;
            }
    
            let image = _.find(value, (elem) => _.toLower(elem.data.name) === _.toLower(name));
            return (!_.isNil(image)) ? image.url : defaultImage;
        } catch (error) {
            console.error(error);
        }
    }
}

export default StringFilters;