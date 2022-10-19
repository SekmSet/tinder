import {StyleSheet, Button, View, SafeAreaView, Image, Text} from 'react-native';
import React, {useEffect} from 'react';

export const Index = () => {

    const unLike = () => {console.log('like')}
    const superLike = () => {console.log('like')}
    const like = () => {console.log('like')}

    useEffect(()=>{
        console.log('tot')
    }, [])
    return (
        <SafeAreaView>
            <View style={styles.container}>
                <Image source={{uri : "https://picsum.photos/200/300"}} style={{ width: 305, height: 500 }} />
                <Text></Text>
                <Button
                    onPress={unLike}
                    title="Unlike"
                    color="#841584"
                    accessibilityLabel="Unlike this profil and never seen yet this profil button"
                />

                <Button
                    onPress={superLike}
                    title="Super like"
                    color="#841584"
                    accessibilityLabel="Super like this profil button"
                />

                <Button
                    onPress={like}
                    title="Like"
                    color="#841584"
                    accessibilityLabel="Like this profil button"
                />
            </View>
        </SafeAreaView>
    )
}

const styles = StyleSheet.create({
    container: {
        borderRadius: 10,
        margin: 10,
        padding: 10,
    }
})