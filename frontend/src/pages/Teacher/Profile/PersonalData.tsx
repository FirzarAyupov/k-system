import React from 'react';
import { Button, Card, Descriptions} from 'antd';
import type {DescriptionsProps} from 'antd';

const items: DescriptionsProps['items'] = [
    {
        key: '1',
        label: 'ФИО',
        children: 'Иванов Иван Иванович',
    },
    {
        key: '2',
        label: 'Дата рождения',
        children: '01.01.1990',
    }
];

const PersonalData: React.FC = () =>
    <Card>
        <Descriptions title="Информация о пользователе" bordered items={items}
                      extra={<Button type="primary">Редактировать</Button>}/>
    </Card>

export default PersonalData;